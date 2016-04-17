CREATE FUNCTION abort()
RETURNS TRIGGER AS $$
BEGIN
	RAISE 'Can''t perform this action';
END
;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION non_editable()
RETURNS TRIGGER AS $$
BEGIN
	RAISE 'Editing disabled on table %', TG_TABLE_NAME;
END
;
$$ LANGUAGE plpgsql;

CREATE TRIGGER addRecord
BEFORE INSERT ON item_history_records
FOR EACH ROW 
WHEN
	((
		NEW.type = 'Add'
		AND
		(	SELECT type, MAX(date) 						--VER SE NÃO EXISTE NENHUM REGISTO ANTERIOR ANTES DE ADICIONAR UM ADD RECORD
			FROM item_history_records
			WHERE id_item_instance = NEW.id_item_instance
		)>0
		 
	)
	OR
	(
		(NEW.type = 'Lend' OR NEW.type = 'Maintenance')			--SE O NOVO REGISTO FOR UM LEND OU UM MAINTENANCE, ENTÃO O ITEM INSTANCE TEM QUE ESTAR DISPONÍVEL
		AND 
		(
			SELECT *
			FROM(SELECT type, MAX(date) 						
				FROM item_history_records
				WHERE id_item_instance = NEW.id_item_instance) AS records
			WHERE type = 'Add' OR type = 'Return' OR type ='Repaired'
		) = 0	
	)
	OR
	(
		NEW.type = 'Return'										--SÓ PODE FAZER RETURN SE O REGISTO FOR UM LEND 
		AND 
		(
			SELECT *
			FROM(SELECT type, MAX(date) 						
				FROM item_history_records
				WHERE id_item_instance = NEW.id_item_instance) AS records
			WHERE type = 'Lend'
		) = 0
	)
	OR
	(
		NEW.type = 'Repaired'									-- SÓ PODE DAR ENTRADA COMO REPARADO SE O REGISTO ANTERIOR FOR UM MAINTENAnCE
		AND 
		(
			SELECT *
			FROM(SELECT type, MAX(date) 						
				FROM item_history_records
				WHERE id_item_instance = NEW.id_item_instance) AS records
			WHERE type = 'Maintenance'
		) = 0
	)
	OR
	(SELECT *
	FROM(SELECT type, MAX(date) 						-- SE O ITEM TIVER SIDO REMOVIDO NÃO SE PODE ADICIONAR MAIS REGISTOS
		FROM item_history_records
		WHERE id_item_instance = NEW.id_item_instance) AS records
	WHERE type = 'Removed') >=0
	)
EXECUTE PROCEDURE abort();


CREATE FUNCTION clientMismatchError()
RETURNS TRIGGER AS $$
BEGIN
	RAISE 'Client mismatch on return_records';
END;
$$ LANGUAGE plpgsql;

/**
 * NÃO DEIXA ADICIONAR UM RETURN RECORD SE O CLIENTE ID NAO FOR O MESMO
 */
CREATE TRIGGER clientMismatch					
BEFORE INSERT ON return_records
FOR EACH ROW 
WHEN
	(
	(SELECT *
	FROM(SELECT *, MAX(date) 						--
		FROM item_history_records
		NATURAL JOIN lend_records, (SELECT id_item_instance FROM item_history_records WHERE id = NEW.id) AS record
		WHERE id_item_instance = record.id_item_instance
			AND id != NEW.id
		) AS recent
	WHERE idClient = NEW.idClient	
	) <= 0 
	)
EXECUTE PROCEDURE clientMismatchError();

CREATE FUNCTION fulfillreservations(recordId INTEGER, idClient INTEGER)
RETURNS TRIGGER AS $$
BEGIN
	CREATE VIEW record AS 
	SELECT id_item_instance, date
	FROM (
		(SELECT * FROM item_history_records WHERE id = recordId)
	);

	UPDATE reservations
	SET fulfilled = TRUE,
	WHERE 	reservations.id_item_instance = record.id_item_instance
	AND 	DATEDIFF(day,reservations.start,record.date) = 0
	AND 	reservations.idClient = idClient;
END
;$$ LANGUAGE plpgsql;

/**
 *	FAZER FULFILL AUTOMATICAMENTE DE UMA RESERVA QUANDO É INSERIDO NO SISTEMA UM LENDRECORD PELO MESMO CLIENTE, NO MESMO DIA DA RESERVA E PELO MESMO ITEMINSTANCE
 */
CREATE TRIGGER fulfillreservations
AFTER INSERT ON lend_records
FOR EACH ROW
WHEN
 	(SELECT *
 	FROM reservations,(SELECT id_item_instance,date, FROM item_history_records WHERE id = NEW.id) AS record
 	WHERE 	reservations.id_item_instance = record.id_item_instance
 	AND 	DATEDIFF(day,reservations.start,record.date) = 0
 	AND 	reservations.idClient = NEW.idClient
 	) >= 1 
EXECUTE PROCEDURE fulfillreservations(NEW.id, NEW.idClient)
;

CREATE FUNCTION deleteDiscardedreservations(recordId INTEGER, idClient INTEGER)
RETURNS TRIGGER AS $$
BEGIN
	CREATE VIEW Record AS 
	SELECT id_item_instance, date
	FROM (
		(SELECT * FROM item_history_records WHERE id = recordId)
	);

	DELETE reservations
	USING	record
	WHERE 	reservations.id_item_instance = record.id_item_instance
	AND 	reservations.fulfilled = 'false'
	AND 	reservations.idClient != NEW.idClient;
END
;$$ LANGUAGE plpgsql;


CREATE TRIGGER deletereservations
AFTER INSERT ON lend_records
FOR EACH ROW
WHEN
 	(SELECT *
 	FROM reservations,(SELECT id_item_instance,date, FROM item_history_records WHERE id = NEW.id) AS record
 	WHERE 	reservations.id_item_instance = record.id_item_instance
 	AND 	reservations.fulfilled = 'false'
 	AND 	reservations.idClient != NEW.idClient
 	) >= 1 
EXECUTE PROCEDURE deleteDiscardedreservations(NEW.id, New.idClient)
;

CREATE TRIGGER checkMaintenance
BEFORE INSERT ON maintenance_records
FOR EACH ROW
WHEN
	(SELECT id
	FROM item_history_records
	WHERE 	id = NEW.id 
	AND 	type = 'Maintenance'	
	) >= 1
EXECUTE PROCEDURE abort();

CREATE TRIGGER checkReturn
BEFORE INSERT ON return_records
FOR EACH ROW
WHEN
	(SELECT id
	FROM item_history_records
	WHERE 	id = NEW.id 
	AND 	type = 'Return'	
	) >= 1
EXECUTE PROCEDURE abort();

CREATE TRIGGER checkLend
BEFORE INSERT ON lend_records
FOR EACH ROW
WHEN
	(SELECT id
	FROM item_history_records
	WHERE 	id = NEW.id 
	AND 	type = 'Lend'	
	) >= 1
EXECUTE PROCEDURE abort();

CREATE TRIGGER checkUser
BEFORE INSERT ON clients
FOR EACH ROW
WHEN
	(SELECT id
	FROM users
	WHERE 	id = NEW.id 
	AND 	type = 'Client'	
	) >= 1
EXECUTE PROCEDURE abort();