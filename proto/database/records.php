<?php
	$maxReservationDays = 7;

	function getLateReturns(){
		global $maxReservationDays;
		global $conn;

		$stmt = $conn->prepare('

														SELECT item_history_records.*, id_client
														FROM item_history_records 
															INNER JOIN (SELECT id_item_instance, max(date) AS date
																					FROM item_history_records
																					GROUP BY id_item_instance) AS recent_records
															ON 
															(item_history_records.id_item_instance = recent_records.id_item_instance AND item_history_records.date = recent_records.date)
															NATURAL JOIN lend_records
														WHERE type = \'Lend\' AND DATE_PART(\'day\',now()-item_history_records.date) > :maxDate ;');
		$stmt->bindParam(":maxDate", $maxReservationDays,PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if(count($result) == 0){
			throw new Exception("Error Processing Request", 1);
		}
		return $result;
	}