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

	function getItem($category, $subcategory, $name){
		global $conn;
		try {
			$conn->beginTransaction();
			$stmt1 = $conn->prepare(
				'SET TRANSACTION ISOLATION LEVEL READ COMMITTED READ ONLY;');
			if ($stmt1) {
				$stmt1->execute();
				$stmt2 = $conn->prepare(
					'SELECT items.id AS id, items.name AS name, subcategories.name AS subcategory, categories.name AS category,
					items.description AS description, items.picture AS picture
					FROM items INNER JOIN subcategories ON items.id_subcategory = subcategories.id
					INNER JOIN categories ON subcategories.id_category = categories.id
					WHERE items.name = :item AND subcategories.name = :subcategory AND categories.name = :category;');
				$stmt2->bindValue(':category', $category, PDO::PARAM_STR);
				$stmt2->bindValue(':subcategory', $subcategory, PDO::PARAM_STR);
				$stmt2->bindValue(':item', $name, PDO::PARAM_STR);
				if($stmt2) {
					$stmt2->execute();
					$res = $stmt2->fetch();
					$conn->commit();
				}
				return $res;
			}
		} catch(PDOException $e) {
			$conn->rollback();
			echo $e->$getMessage();
			exit();
		}

	}

	function addItem($category, $subcategory, $name, $description, $picture){
		global $conn;
		try {
			$stmt = $conn->prepare(
				'INSERT INTO items(name, id_subcategory, description, picture) SELECT :name, subcategories.id, :description, :picture FROM subcategories, categories WHERE categories.name = :category AND categories.id = subcategories.id_category AND subcategories.name = :subcategory;');
			$stmt->bindValue(':category', $category, PDO::PARAM_STR);
			$stmt->bindValue(':description', $description, PDO::PARAM_STR);
			$stmt->bindValue(':subcategory', $category, PDO::PARAM_STR);
			$stmt->bindValue(':name', $category, PDO::PARAM_STR);
			$stmt->bindValue(':picture', $picture, PDO::PARAM_STR);
			$stmt->execute();
		} catch(PDOException $e) {
			echo $e->getMessage();
			exit();
		}
	}

	function getCategories(){
		global $conn;
		try {
			$stmt = $conn->prepare('SELECT * FROM categories; ');
			$stmt->execute();
			$result = $stmt->fetchAll();
			if(count($result)==0){
				return false;
			}
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
			exit();
		}
	}

	function getSubCategories(){
		global $conn;
		try {
			$stmt = $conn->prepare('SELECT * FROM subcategories; ');
			$stmt->execute();
			$result = $stmt->fetchAll();
			if(count($result)==0){
				return false;
			}
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
			exit();
		}
	}

	function getItemInstances($id_item){
		global $conn;
		try {
			$stmt = $conn->prepare('SELECT id FROM item_instances WHERE id_item = :id_item; ');
			$stmt->bindValue(':id_item', $id_item, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			for($i = 0; $i < count($result); $i++)
				$result[$i] = $result[$i]['id'];
		
			if(count($result)==0){
				return false;
			}
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
			exit();
		}
	}