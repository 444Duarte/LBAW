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
		(NEW.type = 'Lend' OR NEW.type = 'Maintenace')			--SE O NOVO REGISTO FOR UM LEND OU UM MAINTENANCE, ENTÃO O ITEM INSTANCE TEM QUE ESTAR DISPONÍVEL
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
		NEW.type = 'Repaired'									-- SÓ PODE DAR ENTRADA COMO REPARADO SE O REGISTO ANTERIOR FOR UM MAINTENACE
		AND 
		(
			SELECT *
			FROM(SELECT type, MAX(date) 						
				FROM ItemHistoryRecord
				WHERE idItemInstance = NEW.idItemInstance)
			WHERE type = 'Maintenace'
		) = 0
	)
	OR
	(SELECT *
	FROM(SELECT type, MAX(date) 						-- SE O ITEM TIVER SIDO REMOVIDO NÃO SE PODE ADICIONAR MAIS REGISTOS
		FROM ItemHistoryRecord
		WHERE idItemInstance = NEW.idItemInstance)
	WHERE type = 'Removed') >=0
BEGIN
	SELECT RAISE (ABORT, "Can't perform this action");
END
;

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
		NATURAL JOIN LendRecord
		WHERE idItemInstance = NEW.idItemInstance)
	WHERE idClient = NEW.idClient	
	) <= 0
BEGIN
	SELECT RAISE (ABORT, "Client mismatch on ReturnRecord");
END
;	