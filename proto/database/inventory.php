<?php 
	function getItemList($start, $nItems){
		global $conn;
		$stmt = $conn->prepare(
			"SELECT items.name as name, subcategories.name as subcategory, categories.name as category, items.picture as picture
			FROM items, subcategories, categories
			WHERE items.id_subcategory = subcategories.id
				AND subcategories.id_category = categories.id
			ORDER BY name
			LIMIT ?
			OFFSET ?;");
		$stmt->bindValue(1, $nItems, PDO::PARAM_INT);
		$stmt->bindValue(2, $start, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
	}

	function getItemCount(){
		global $conn;
		$stmt = $conn->prepare(
			"SELECT COUNT(*) AS count FROM items");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result['count'];
	}
?>