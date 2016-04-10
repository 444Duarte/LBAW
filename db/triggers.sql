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
		(NEW.type = 'Lend' OR NEW.type = 'Maintenace')
		AND 
		(
			SELECT *
			FROM(SELECT type, MAX(date) 						--
				FROM ItemHistoryRecord
				WHERE idItemInstance = NEW.idItemInstance)
			WHERE type = 'Add' OR type = 'Return' OR type ='Repaired'
		) = 0	
	)
	OR
	(
		NEW.type = 'Return'
		AND 
		(
			SELECT *
			FROM(SELECT type, MAX(date) 						--
				FROM ItemHistoryRecord
				WHERE idItemInstance = NEW.idItemInstance)
			WHERE type = 'Lend'
		) = 0
	)
	OR
	(
		NEW.type = 'Repaired'
		AND 
		(
			SELECT *
			FROM(SELECT type, MAX(date) 						--
				FROM ItemHistoryRecord
				WHERE idItemInstance = NEW.idItemInstance)
			WHERE type = 'Maintenace'
		) = 0
	)
BEGIN
	SELECT RAISE (ABORT, "Can't perform this action");
END
;