<?php
	include_once '../config/init.php';
	include_once $BASE_DIR . 'database/records.php';
	include_once $BASE_DIR . 'database/users.php';


	$lateList = getLateReturns();

	foreach($lateList as $lateReturn){
		$idClient = $lateReturn['id_client'];
		$emailClient = getUserEmail($idClient);
		$itemInstance = $lateReturn['id_item_instance'];
		echo 'Sending email to ' . $emailClient .' warning to return item id: '. $itemInstance . '\n';
		//mail($emailClient, 'Late return of item', 'Dear sir,\nYou should have already retunred item id: '. $itemInstance .' \n Regards,\nToolBox Team');
	}
