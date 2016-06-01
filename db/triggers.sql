DROP TRIGGER IF EXISTS add_record ON item_history_records;
DROP TRIGGER IF EXISTS client_mismatch ON return_records;
DROP TRIGGER IF EXISTS automatic_fulfill_reservations ON lend_records;
DROP TRIGGER IF EXISTS delete_reservations ON lend_records;
DROP TRIGGER IF EXISTS check_maintenance ON maintenance_records;
DROP TRIGGER IF EXISTS check_return ON return_records;
DROP TRIGGER IF EXISTS check_lend ON lend_records;
DROP TRIGGER IF EXISTS check_user ON clients;
DROP TRIGGER IF EXISTS check_valid_reservation ON reservations;
DROP TRIGGER IF EXISTS check_expected_end ON maintenance_records;
DROP TRIGGER IF EXISTS check_id_inventory_manager ON item_history_records;
DROP TRIGGER IF EXISTS check_email_pre_register ON pre_registers;
DROP TRIGGER IF EXISTS delete_pre_register ON users;

CREATE OR REPLACE FUNCTION abort()
RETURNS TRIGGER AS $$
BEGIN
	RAISE 'Can''t perform this action';
	RETURN NEW;
END
;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION non_editable()
RETURNS TRIGGER AS $$
BEGIN
	RAISE 'Editing disabled on table %', TG_TABLE_NAME;
	RETURN NEW;
END
;
$$ LANGUAGE plpgsql;

/**
 * VER SE NÃO EXISTE NENHUM REGISTO ANTERIOR ANTES DE ADICIONAR UM ADD RECORD
 */
CREATE OR REPLACE FUNCTION check_reg_not_exists(id_item_inst Integer)
RETURNS BOOLEAN AS $$
BEGIN
	RETURN
		NOT EXISTS(	SELECT item_history_records.type, date
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
				WHERE records.type = 'Add' OR records.type = 'Return' OR records.type ='Repaired'
		);
END
;
$$ LANGUAGE plpgsql;

/**
 * SÓ PODE FAZER RETURN SE O REGISTO FOR UM LEND 
 */
CREATE OR REPLACE FUNCTION check_can_return(id_item_inst Integer)
RETURNS BOOLEAN AS $$
BEGIN
	RETURN 
		EXISTS(SELECT 1
				FROM(SELECT item_history_records.type, date 						
					FROM item_history_records
					WHERE id_item_instance = id_item_inst
					ORDER BY date DESC LIMIT 1
					) AS records
				WHERE records.type = 'Lend'
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
			WHERE records.type = 'Maintenance'
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
				WHERE records.type = 'Remove')
	;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION check_add_record()
RETURNS TRIGGER AS $$
BEGIN
	IF 	(	(NEW.type = 'Add'									AND NOT check_reg_not_exists(NEW.id_item_instance)) 
		OR 	((NEW.type = 'Lend' OR NEW.type = 'Maintenance') 	AND NOT check_available(NEW.id_item_instance))
		OR 	(NEW.type = 'Return' 								AND NOT check_can_return(NEW.id_item_instance))
		OR 	(NEW.type = 'Repaired'								AND NOT check_in_maintenance(NEW.id_item_instance))
		OR 	(check_was_removed(NEW.id_item_instance) ) )
	THEN
		RAISE 'Can''t perform this action';
	END IF;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER add_record
BEFORE INSERT ON item_history_records
FOR EACH ROW 
EXECUTE PROCEDURE check_add_record();


CREATE OR REPLACE FUNCTION return_records_insert()
RETURNS TRIGGER AS $$
BEGIN
	IF EXISTS (	SELECT 1
				FROM(SELECT lend_complete.id_client as id_client 						--
					FROM (item_history_records NATURAL JOIN lend_records) AS lend_complete, (SELECT id_item_instance FROM item_history_records WHERE item_history_records.id = NEW.id) AS record
					WHERE lend_complete.id_item_instance = record.id_item_instance
						AND lend_complete.id != NEW.id
					ORDER BY date DESC LIMIT 1
					) AS recent
				WHERE recent.id_client != NEW.id_client	
				) 

	THEN RAISE 'Client mismatch on return_records';
	END IF;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

/**
 * NÃO DEIXA ADICIONAR UM RETURN RECORD SE O CLIENTE ID NAO FOR O MESMO
 */
CREATE TRIGGER client_mismatch					
BEFORE INSERT ON return_records
FOR EACH ROW	
EXECUTE PROCEDURE return_records_insert();

/*
CREATE OR REPLACE FUNCTION fulfill_reservations()
RETURNS TRIGGER AS $$
BEGIN
	WITH record AS( 
	SELECT id_item_instance, date
	FROM  item_history_records 
	WHERE id = NEW.id
	)

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
	RETURN NEW;
END
;$$ LANGUAGE plpgsql;

/**
 *	FAZER FULFILL AUTOMATICAMENTE DE UMA RESERVA QUANDO É INSERIDO NO SISTEMA UM LENDRECORD PELO MESMO CLIENTE, NO MESMO DIA DA RESERVA E PELO MESMO ITEMINSTANCE
 */
CREATE TRIGGER automatic_fulfill_reservations
AFTER INSERT ON lend_records
FOR EACH ROW
EXECUTE PROCEDURE fulfill_reservations()
;

CREATE OR REPLACE FUNCTION delete_discarded_reservations()
RETURNS TRIGGER AS $$
BEGIN
	WITH record AS( 
	SELECT id_item_instance, date
	FROM item_history_records 
	WHERE id = NEW.id
	)

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
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER delete_reservations
AFTER INSERT ON lend_records
FOR EACH ROW 
EXECUTE PROCEDURE delete_discarded_reservations()
;
*/

CREATE OR REPLACE FUNCTION check_maintenance_abort()
RETURNS TRIGGER AS $$
BEGIN
	IF NOT EXISTS (	SELECT id
				FROM item_history_records
				WHERE 	id = NEW.id 
				AND 	type = 'Maintenance'	
				)

	THEN RAISE 'Can''t perform this action';
	END IF;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

/**
 * Verifica se a um maintenace está associado um item_history_record listado como Maintenace
 */
CREATE TRIGGER check_maintenance
BEFORE INSERT ON maintenance_records
FOR EACH ROW
EXECUTE PROCEDURE check_maintenance_abort();

CREATE OR REPLACE FUNCTION check_return_abort()
RETURNS TRIGGER AS $$
BEGIN
	IF NOT EXISTS (SELECT id
				FROM item_history_records
				WHERE 	id = NEW.id 
				AND 	type = 'Return'	
				)

	THEN RAISE 'Can''t perform this action';
	END IF;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

/**
 * Verifica se o item_history_record associado ao return tem type = "Return"
 */
CREATE TRIGGER check_return
BEFORE INSERT ON return_records
FOR EACH ROW
EXECUTE PROCEDURE check_return_abort();


CREATE OR REPLACE FUNCTION check_lend_abort()
RETURNS TRIGGER AS $$
BEGIN
	IF NOT EXISTS (SELECT id
				FROM item_history_records
				WHERE 	id = NEW.id 
				AND 	type = 'Lend'	
				)

	THEN RAISE 'Can''t perform this action';
	END IF;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

/**
 * Verifica se o item_history_record associado ao lend tem type = "Lend"
 */
CREATE TRIGGER check_lend
BEFORE INSERT ON lend_records
FOR EACH ROW
EXECUTE PROCEDURE check_lend_abort();

CREATE OR REPLACE FUNCTION check_user_abort()
RETURNS TRIGGER AS $$
BEGIN
	IF NOT EXISTS(	SELECT id
					FROM users
					WHERE 	id = NEW.id 
					AND 	type = 'Client'	
					)

	THEN RAISE 'Can''t perform this action';
	END IF;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

/**
 * Verifica se o user associado ao client tem type = "Client"
 */
CREATE TRIGGER check_user
BEFORE INSERT ON clients
FOR EACH ROW
EXECUTE PROCEDURE check_user_abort();

/**
 * Verifica se já existe uma reserva para uma instancia de um item durante aquele período
 */
CREATE OR REPLACE FUNCTION check_instance_free(id_reservation Integer, id_item_inst Integer, start_t TIMESTAMP, end_t TIMESTAMP)
RETURNS BOOLEAN AS $$
BEGIN
	RETURN  
		EXISTS(SELECT *
				FROM reservations 
				WHERE	reservations.id != id_reservation
				AND 	reservations.id_item_instance = id_item_inst
				AND (	
						(start_t >=reservations.start_time 
						AND 
						start_t <= reservations.end_time)
					OR
						(end_t >=reservations.start_time 
						AND 
						end_t <= reservations.end_time)
					)	
				)	
	;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION cancel_reservation()
RETURNS TRIGGER AS $$
BEGIN
	IF 												
		check_was_removed(NEW.id_item_instance)
	THEN
		RAISE 'Can''t book a removed instance';
	END IF;
	
	IF 	
		check_instance_free(NEW.id, NEW.id_item_instance, NEW.start_time, NEW.end_time)			---
	THEN	
		RAISE 'Item instance already booked during parts of this period';
	END IF;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_valid_reservation
BEFORE INSERT ON reservations
FOR EACH ROW
EXECUTE PROCEDURE cancel_reservation();

/**
 * Verifica se o expected end é maior que a date em que o record foi 
 */
CREATE OR REPLACE FUNCTION valid_expected_end()
RETURNS TRIGGER AS $$
BEGIN
	IF EXISTS ( SELECT 1
				FROM item_history_records
				WHERE 	item_history_records.id = NEW.id 
				AND 	item_history_records.date > NEW.expected_end
			)
	THEN
		RAISE 'Expected end smaller then record date';
	END IF;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_expected_end
BEFORE INSERT ON maintenance_records
FOR EACH ROW
EXECUTE PROCEDURE valid_expected_end();


/**
 * Verifica se o User introduzido como inventory manager está listado como inventory manager
 */
CREATE OR REPLACE FUNCTION is_inventory_manager()
RETURNS TRIGGER AS $$
BEGIN
	IF 	NEW.id_inventory_manager 
		NOT IN (SELECT id
				FROM users
				WHERE 	type = 'InventoryManager'
			)
	THEN
		RAISE 'Given InventoryManager user is not listed as an InventoryManager';
	END IF;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_id_inventory_manager
BEFORE INSERT ON item_history_records
FOR EACH ROW
EXECUTE PROCEDURE is_inventory_manager();


/**
 *	Checks if there is already an user with the email
 */
CREATE OR REPLACE FUNCTION email_exists()
RETURNS TRIGGER AS $$
BEGIN
	IF 	NEW.email 
		IN (SELECT email
			FROM users)
	THEN
		RAISE 'Given email already in the database ';
	END IF;
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;


/**
 *	Deletes all pre_registers with the same email as the new user
 */
CREATE TRIGGER check_email_pre_register
BEFORE INSERT ON pre_registers 
FOR EACH ROW 
EXECUTE PROCEDURE email_exists();

CREATE OR REPLACE FUNCTION delete_pre_register()
RETURNS TRIGGER AS $$
BEGIN
	DELETE FROM pre_registers
	WHERE email = NEW.email;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER delete_pre_register
AFTER INSERT ON users 
FOR EACH ROW 
EXECUTE PROCEDURE email_exists();