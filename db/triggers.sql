CREATE OR REPLACE FUNCTION abort()
RETURNS TRIGGER AS $$
BEGIN
	RAISE 'Can''t perform this action';
END
;
$$ LANGUAGE plpgsql;

/**
 * VER SE NÃO EXISTE NENHUM REGISTO ANTERIOR ANTES DE ADICIONAR UM ADD RECORD
 */
CREATE OR REPLACE FUNCTION check_reg_not_exists(type record_type,id_item_inst Integer)
RETURNS BOOLEAN AS $$
BEGIN
	RETURN
		type = 'Add'
		AND
		EXISTS(	SELECT type, date
			FROM item_history_records
			WHERE item_history_records.id_item_instance = id_item_inst
			ORDER BY date DESC LIMIT 1
		);
END
;
$$ LANGUAGE plpgsql;

/**
 * --SE O NOVO REGISTO FOR UM LEND OU UM MAINTENANCE, ENTÃO O ITEM INSTANCE TEM QUE ESTAR DISPONÍVEL
 */
CREATE OR REPLACE FUNCTION check_available(id_item_inst Integer)
RETURNS BOOLEAN AS $$
BEGIN
	RETURN
		EXISTS(	SELECT 1
				FROM (SELECT type, date					
					FROM item_history_records
					WHERE id_item_instance = id_item_inst
					ORDER BY date DESC LIMIT 1) AS records
				WHERE type = 'Add' OR type = 'Return' OR type ='Repaired'
		);
END
;
$$ LANGUAGE plpgsql;

/**
 * SÓ PODE FAZER RETURN SE O REGISTO FOR UM LEND 
 */
CREATE OR REPLACE FUNCTION check_can_return(type record_type, id_item_inst Integer)
RETURNS BOOLEAN AS $$
BEGIN
	RETURN 
		type = 'Return'
		AND
		EXISTS(SELECT 1
				FROM(SELECT type, date 						
					FROM item_history_records
					WHERE id_item_instance = id_item_inst
					ORDER BY date DESC LIMIT 1
					) AS records
				WHERE type = 'Lend'
			);
END;
$$ LANGUAGE plpgsql;

/**
 * VERIFICA SE UM ITEM ESTÁ EM REPARAÇÃO
 */
CREATE OR REPLACE FUNCTION check_in_maintenance(id_item_inst Integer)
RETURNS BOOLEAN AS $$
BEGIN
	RETURN  
		EXISTS(
			SELECT *
			FROM(SELECT type, date 						
				FROM item_history_records
				WHERE id_item_instance = id_item_inst
				ORDER BY date DESC LIMIT 1
				) AS records
			WHERE type = 'Maintenance'
		);
END;
$$ LANGUAGE plpgsql;


/**
 * Verifica se o ultimo registo de um item instance é um REMOVED
 */
CREATE OR REPLACE FUNCTION check_was_removed(id_item_inst Integer)
RETURNS BOOLEAN AS $$
BEGIN
	RETURN  
		EXISTS(SELECT *
				FROM(SELECT type, date
					FROM item_history_records
					WHERE id_item_instance = id_item_inst
					ORDER BY date DESC LIMIT 1) AS records
				WHERE type = 'Removed')
	;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION check_add_record()
RETURNS TRIGGER AS $$
BEGIN
	IF 	(check_reg_not_exists(NEW.type, NEW.id_item_instance)) 
		OR 	(	NEW.type = 'Lend' OR NEW.type = 'Maintenance'
			 AND check_available(NEW.id_item_instance))
		OR 	(check_can_return(NEW.type, NEW.id_item_instance))
		OR 	(	NEW.type = 'Repaired'
			AND check_in_maintenance(NEW.id_item_instance))
		OR 	(check_was_removed(NEW.id_item_instance) )
	THEN
		RAISE 'Can''t perform this action';
	END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER add_record
BEFORE INSERT ON item_history_records
FOR EACH ROW 
EXECUTE PROCEDURE check_add_record();


CREATE OR REPLACE FUNCTION return_records_insert()
RETURNS TRIGGER AS $$
BEGIN
	IF EXISTS (	SELECT *
				FROM(SELECT *, MAX(date) 						--
					FROM item_history_records
					NATURAL JOIN lend_records, (SELECT id_item_instance FROM item_history_records WHERE item_history_records.id = id) AS record
					WHERE id_item_instance = record.id_item_instance
						AND lend_records.id != NEW.id
					) AS recent
				WHERE lend_records.idClient = NEW.idClient	
				) 

	THEN RAISE 'Client mismatch on return_records';
END;
$$ LANGUAGE plpgsql;

/**
 * NÃO DEIXA ADICIONAR UM RETURN RECORD SE O CLIENTE ID NAO FOR O MESMO
 */
CREATE TRIGGER client_mismatch					
BEFORE INSERT ON return_records
FOR EACH ROW	
EXECUTE PROCEDURE return_records_insert();

CREATE OR REPLACE FUNCTION fulfill_reservations()
RETURNS TRIGGER AS $$
BEGIN
	CREATE TEMP VIEW record AS 
	SELECT id_item_instance, date
	FROM  item_history_records 
	WHERE id = NEW.id;

	IF EXISTS (SELECT 1
			 	FROM reservations,record
			 	WHERE 	reservations.id_item_instance = record.id_item_instance
			 	AND 	reservations.fulfilled = 'false'
			 	AND 	record.date >= reservations.start_time
			 	AND 	record.date < reservations.end_time
			 	AND 	reservations.idClient = NEW.idClient
			 	)
	THEN
		UPDATE reservations
		SET fulfilled = TRUE
		WHERE 	reservations.id_item_instance = record.id_item_instance
		AND 	record.date >= reservations.start_time
		AND 	record.date < reservations.end_time
		AND 	reservations.idClient = NEW.idClient;
	END IF;
END
;$$ LANGUAGE plpgsql;

/**
 *	FAZER FULFILL AUTOMATICAMENTE DE UMA RESERVA QUANDO É INSERIDO NO SISTEMA UM LENDRECORD PELO MESMO CLIENTE, NO MESMO DIA DA RESERVA E PELO MESMO ITEMINSTANCE
 */
CREATE TRIGGER fulfillreservations
AFTER INSERT ON lend_records
FOR EACH ROW
EXECUTE PROCEDURE fulfillreservations()
;

CREATE OR REPLACE FUNCTION deleteDiscardedreservations()
RETURNS TRIGGER AS $$
BEGIN
	CREATE TEMP VIEW record AS 
	SELECT id_item_instance, date
	FROM item_history_records 
	WHERE id = NEW.id;

	IF EXISTS (SELECT 1
			 	FROM reservations, record
			 	WHERE 	reservations.id_item_instance = record.id_item_instance
			 	AND 	reservations.fulfilled = 'false'
			 	AND 	record.date >= reservations.start_time
			 	AND 	record.date < reservations.end_time
			 	AND 	reservations.idClient != NEW.idClient
			 	)
 	THEN
		

		DELETE 
		FROM reservations
		USING	record
		WHERE 	reservations.id_item_instance = record.id_item_instance
		AND 	reservations.fulfilled = 'false'
		AND 	record.date >= reservations.start_time
	 	AND 	record.date < reservations.end_time
		AND 	reservations.idClient != NEW.idClient;
	END IF;
END
;$$ LANGUAGE plpgsql;


CREATE TRIGGER deletereservations
AFTER INSERT ON lend_records
FOR EACH ROW 
EXECUTE PROCEDURE deleteDiscardedreservations()
;

CREATE OR REPLACE FUNCTION check_maintenance_abort()
RETURNS TRIGGER AS $$
BEGIN
	IF EXISTS (	SELECT id
				FROM item_history_records
				WHERE 	id = NEW.id 
				AND 	type = 'Maintenance'	
				)

	THEN RAISE 'Can''t perform this action';
	END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER checkMaintenance
BEFORE INSERT ON maintenance_records
FOR EACH ROW
EXECUTE PROCEDURE check_maintenance_abort();

CREATE OR REPLACE FUNCTION check_return_abort()
RETURNS TRIGGER AS $$
BEGIN
	IF EXISTS (SELECT id
				FROM item_history_records
				WHERE 	id = NEW.id 
				AND 	type = 'Return'	
				)

	THEN RAISE 'Can''t perform this action';
	END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER checkReturn
BEFORE INSERT ON return_records
FOR EACH ROW
EXECUTE PROCEDURE check_return_abort();


CREATE OR REPLACE FUNCTION check_lend_abort()
RETURNS TRIGGER AS $$
BEGIN
	IF EXISTS (SELECT id
				FROM item_history_records
				WHERE 	id = NEW.id 
				AND 	type = 'Lend'	
				)

	THEN RAISE 'Can''t perform this action';
	END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_lend
BEFORE INSERT ON lend_records
FOR EACH ROW
EXECUTE PROCEDURE check_lend_abort();


CREATE OR REPLACE FUNCTION check_user_abort()
RETURNS TRIGGER AS $$
BEGIN
	IF EXISTS(	SELECT id
				FROM users
				WHERE 	id = NEW.id 
				AND 	type = 'Client'	
				)

	THEN RAISE 'Can''t perform this action';
	END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_user
BEFORE INSERT ON clients
FOR EACH ROW
EXECUTE PROCEDURE check_user_abort();