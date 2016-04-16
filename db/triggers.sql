CREATE FUNCTION abort()
RETURNS TRIGGER AS $$
BEGIN
	RAISE 'Can\'t perform this action');
END
;
$$ LANGUAGE plpgsql;

CREATE TRIGGER addRecord
BEFORE INSERT ON ItemHistoryRecord
FOR EACH ROW 
WHEN
	(
		NEW.type = 'Add'
		AND
		(	SELECT type, MAX(date) 						--VER SE NÃO EXISTE NENHUM REGISTO ANTERIOR ANTES DE ADICIONAR UM ADD RECORD
			FROM ItemHistoryRecord
			WHERE idItemInstance = NEW.idItemInstance
		)>0
		 
	)
	OR
	(
		(NEW.type = 'Lend' OR NEW.type = 'Maintenance')			--SE O NOVO REGISTO FOR UM LEND OU UM MAINTENANCE, ENTÃO O ITEM INSTANCE TEM QUE ESTAR DISPONÍVEL
		AND 
		(
			SELECT *
			FROM(SELECT type, MAX(date) 						
				FROM ItemHistoryRecord
				WHERE idItemInstance = NEW.idItemInstance)
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
				FROM ItemHistoryRecord
				WHERE idItemInstance = NEW.idItemInstance)
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
				FROM ItemHistoryRecord
				WHERE idItemInstance = NEW.idItemInstance)
			WHERE type = 'Maintenance'
		) = 0
	)
	OR
	(SELECT *
	FROM(SELECT type, MAX(date) 						-- SE O ITEM TIVER SIDO REMOVIDO NÃO SE PODE ADICIONAR MAIS REGISTOS
		FROM ItemHistoryRecord
		WHERE idItemInstance = NEW.idItemInstance)
	WHERE type = 'Removed') >=0
EXECUTE PROCEDURE abort();


CREATE FUNCTION clientMismatchError()
RETURNS TRIGGER AS $$
BEGIN
	RAISE 'Client mismatch on ReturnRecord';
END;
$$ LANGUAGE plpgsql;

/**
 * NÃO DEIXA ADICIONAR UM RETURN RECORD SE O CLIENTE ID NAO FOR O MESMO
 */
CREATE TRIGGER clientMismatch					
BEFORE INSERT ON ReturnRecord
FOR EACH ROW 
WHEN
	(SELECT *
	FROM(SELECT *, MAX(date) 						--
		FROM ItemHistoryRecord
		NATURAL JOIN LendRecord, (SELECT idItemInstance FROM ItemHistoryRecord WHERE id = NEW.id) AS Record
		WHERE idItemInstance = Record.idItemInstance
			AND id != NEW.id
		)
	WHERE idClient = NEW.idClient	
	) <= 0
EXECUTE PROCEDURE clientMismatchError()
;

CREATE FUNCTION fulfillReservation(recordId INTEGER, idClient INTEGER)
RETURNS TRIGGER AS $$
BEGIN
	CREATE VIEW Record AS 
	SELECT idItemInstance, date
	FROM (
		(SELECT * FROM ItemHistoryRecord WHERE id = recordId)
	);

	UPDATE Reservation
	SET fulfilled = TRUE,
	WHERE 	Reservation.idItemInstance = Record.idItemInstance
	AND 	DATEDIFF(day,Reservation.start,Record.date) = 0
	AND 	Reservation.idClient = idClient;
END
;$$ LANGUAGE plpgsql;

/**
 *	FAZER FULFILL AUTOMATICAMENTE DE UMA RESERVA QUANDO É INSERIDO NO SISTEMA UM LENDRECORD PELO MESMO CLIENTE, NO MESMO DIA DA RESERVA E PELO MESMO ITEMINSTANCE
 */
CREATE TRIGGER fulfillReservation
BEFORE INSERT ON LendRecord
FOR EACH ROW
WHEN
 	(SELECT *
 	FROM Reservation,(SELECT idItemInstance,date, FROM ItemHistoryRecord WHERE id = NEW.id) AS Record
 	WHERE 	Reservation.idItemInstance = Record.idItemInstance
 	AND 	DATEDIFF(day,Reservation.start,Record.date) = 0
 	AND 	Reservation.idClient = NEW.idClient
 	) >= 1 
EXECUTE PROCEDURE fulfillReservation(NEW.id, NEW.idClient)
;

CREATE FUNCTION deleteDiscardedReservation(recordId INTEGER, idClient INTEGER)
RETURNS TRIGGER AS $$
BEGIN
	CREATE VIEW Record AS 
	SELECT idItemInstance, date
	FROM (
		(SELECT * FROM ItemHistoryRecord WHERE id = recordId)
	);

	DELETE Reservation
	USING	Record
	WHERE 	Reservation.idItemInstance = Record.idItemInstance
	AND 	DATEDIFF(day,Reservation.start,Record.date) = 0
	AND 	Reservation.idClient != NEW.idClient;
END
;$$ LANGUAGE plpgsql;


CREATE TRIGGER deleteReservation
BEFORE INSERT ON LendRecord
FOR EACH ROW
WHEN
 	(SELECT *
 	FROM Reservation,(SELECT idItemInstance,date, FROM ItemHistoryRecord WHERE id = NEW.id) AS Record
 	WHERE 	Reservation.idItemInstance = Record.idItemInstance
 	AND 	DATEDIFF(day,Reservation.start,Record.date) = 0
 	AND 	Reservation.idClient != NEW.idClient
 	) >= 1 
EXECUTE PROCEDURE deleteDiscardedReservation(NEW.id, New.idClient)
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
BEFORE INSERT ON lend_record
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