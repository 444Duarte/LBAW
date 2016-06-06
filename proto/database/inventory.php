<?php 
	function getItemList($start, $nItems){
		global $conn;
		$stmt = $conn->prepare(
			"SELECT items.name as name, subcategories.name as subcategory, categories.name as category, items.picture as picture
			FROM items, subcategories, categories
			WHERE items.id_subcategory = subcategories.id
				AND subcategories.id_category = categories.id
				AND items.removed = FALSE
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
			"SELECT COUNT(*) AS count FROM items
			WHERE items.removed = FALSE");
		$stmt->execute();
		$result = $stmt->fetch();
		return $result['count'];
	}

	function getSubcategoryItemCount($category, $subcategory){
		global $conn;
		$stmt = $conn->prepare(
			"SELECT COUNT(*) AS count FROM items, subcategories, categories
			WHERE items.id_subcategory = subcategories.id
			AND subcategories.id_category = categories.id
			AND categories.name = ?
			AND subcategories.name = ?
			AND items.removed = FALSE");
		$stmt->bindValue(1, $category, PDO::PARAM_STR);
		$stmt->bindValue(2, $subcategory, PDO::PARAM_STR);
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
		
		$stmt = $conn->prepare(
			'INSERT INTO items(name, id_subcategory, description, picture) VALUES (:name,:subcategory,:description,:picture)');
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->bindValue(':subcategory', $subcategory, PDO::PARAM_INT);
		$stmt->bindValue(':description', $description, PDO::PARAM_STR);
		$stmt->bindValue(':picture', $picture, PDO::PARAM_STR);
		return $stmt->execute();		
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

	function getSubcategoryItemList($category, $subcategory, $start, $nItems){
		global $conn;
		$stmt = $conn->prepare(
			"SELECT items.name as name, subcategories.name as subcategory, categories.name as category, items.picture as picture
			FROM items, subcategories, categories
			WHERE items.id_subcategory = subcategories.id
				AND subcategories.id_category = categories.id
				AND categories.name = ?
				AND subcategories.name = ?
				AND items.removed = FALSE
			ORDER BY name
			LIMIT ?
			OFFSET ?;");
		$stmt->bindValue(1, $category, PDO::PARAM_STR);
		$stmt->bindValue(2, $subcategory, PDO::PARAM_STR);
		$stmt->bindValue(3, $nItems, PDO::PARAM_INT);
		$stmt->bindValue(4, $start, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
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
	
	function fullTextSearch($search, $offset, $limit) {
		global $conn;
		try {
			$stmt = $conn->prepare("SELECT * FROM items, plainto_tsquery(:search) query
							WHERE query @@ tsv
							ORDER BY ts_rank(tsv, query) DESC LIMIT :limit OFFSET :offset;");
			$stmt->execute(array($search, $limit, $offset));
			
			return $stmt->fetchAll();
		}
	}
	
	function getItemRecords($id_item, $offset, $limit) {
		global $conn;
		try {
			$conn->beginTransaction();
			$stmt1 = $conn->prepare('SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;');
		  
		  if(!$stmt1)
			throw new PDOException("Error Processing Request", 1);
			
		  $stmt1->execute();
		  
		  $stmt2 = $conn->prepare(
			"SELECT item_history_records.id, item_instances.id AS item_instance, item_history_records.date,
				item_history_records.type, users.username AS inventory_manager INTO TEMP instance_records FROM
				(item_instances INNER JOIN item_history_records ON item_instances.id = item_history_records.id_item_instance)
				INNER JOIN users ON item_history_records.id_inventory_manager = users.id WHERE id_item = ?
				ORDER BY date DESC OFFSET ? LIMIT ?;");

		  if(!$stmt2)
			throw new PDOException("Error Processing Request", 1);

		  $stmt2->execute(array($id_item, $offset, $limit));

		  $stmt3 = $conn->prepare(
		  "(SELECT instance_records.item_instance, instance_records.type, instance_records.date, instance_records.inventory_manager, NULL AS entity FROM instance_records WHERE (TYPE = 'Add' OR TYPE = 'Repaired' OR TYPE = 'Remove'))
			UNION ALL
			(SELECT instance_records.item_instance, instance_records.type, instance_records.date, instance_records.inventory_manager, users.username AS entity FROM instance_records INNER JOIN lend_records ON (TYPE = 'Lend' AND lend_records.id = instance_records.id) INNER JOIN users ON lend_records.id_client = users.id)
			UNION ALL
			(SELECT instance_records.item_instance, instance_records.type, instance_records.date, instance_records.inventory_manager, users.username AS entity FROM instance_records INNER JOIN return_records ON (TYPE = 'Return' AND return_records.id = instance_records.id)
			INNER JOIN users ON return_records.id_client = users.id)
			UNION ALL
			(SELECT instance_records.item_instance, instance_records.type, instance_records.date, instance_records.inventory_manager, repairer AS entity FROM instance_records INNER JOIN maintenance_records ON maintenance_records.id = instance_records.id)
			ORDER BY DATE DESC;");

		  if (!$stmt3)
			throw new PDOException("Error Processing Request", 1);

		  $stmt3->execute();
		  
		  $result = $stmt3->fetchAll();

		  $conn->commit();
		  
		  return $result; 
		}catch(PDOException $e) {
		  $conn->rollback();
		  echo $e->getMessage();
		  return false;
		}
	}

	function getInstancesInfo($category, $subcategory, $name){
		global $conn;
		$stmt = $conn->prepare("SELECT item_instances.id AS id, item_instances.condition AS condition FROM item_instances, items, categories, subcategories
			WHERE item_instances.id_item = items.id AND items.name = :item AND items.id_subcategory = subcategories.id
			AND subcategories.name = :subcategory AND subcategories.id_category = categories.id AND categories.name = :category;"
		);
		$stmt->bindValue(':category', $category, PDO::PARAM_STR);
		$stmt->bindValue(':subcategory', $subcategory, PDO::PARAM_STR);
		$stmt->bindValue(':item', $name, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
	}

	function getInstanceState($id){
		global $conn;
		$stmt = $conn->prepare("SELECT item_history_records.id AS id, item_history_records.type AS type FROM item_history_records WHERE item_history_records.id_item_instance = :id
			ORDER BY id DESC;"
			);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetch();
		return $result;
	}

	function createSubCategory($nameSubCategory, $idCategory){
		global $conn;
		
		$stmt = $conn->prepare(
			'INSERT INTO subcategories(name,id_category) VALUES (:name,:category)');
		$stmt->bindValue(':name', $nameSubCategory, PDO::PARAM_STR);
		$stmt->bindValue(':category', $idCategory, PDO::PARAM_INT);
		return $stmt->execute();
	}

	function createCategory($nameCategory){
		global $conn;
		
		$stmt = $conn->prepare(
			'INSERT INTO categories(name) VALUES (:name)');
		$stmt->bindValue(':name', $nameCategory, PDO::PARAM_STR);
		return $stmt->execute();
	}

	function getReservations($id_item){
		global $conn;
		try {
			$stmt = $conn->prepare('SELECT users.username, reservations.id_client, reservations.id_item_instance, reservations.start_time, reservations.end_time FROM users, reservations, item_instances WHERE reservations.id_item_instance = item_instances.id AND item_instances.id_item = :id AND users.id = reservations.id_client; ');
			$stmt->bindValue(':id', $id_item, PDO::PARAM_INT);
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

	function getCategorySubcategoryList($category, $start, $nItems){
		global $conn;
		$stmt = $conn->prepare(
			"SELECT DISTINCT ON (subcategories.name) subcategories.name as subcategory, items.picture as picture
			FROM subcategories, categories, items
			WHERE subcategories.id_category = categories.id
				AND categories.name = ?
				AND items.id_subcategory = subcategories.id
			ORDER BY subcategories.name
			LIMIT ?
			OFFSET ?;");
		$stmt->bindValue(1, $category, PDO::PARAM_STR);
		$stmt->bindValue(2, $nItems, PDO::PARAM_INT);
		$stmt->bindValue(3, $start, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
	}

	function getCategorySubcategoryCount($category){
		global $conn;
		$stmt = $conn->prepare(
			"SELECT COUNT(*) AS count FROM categories, subcategories
			WHERE subcategories.id_category = categories.id
			AND categories.name = ?");
		$stmt->bindValue(1, $category, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result['count'];
	}

	function getAverageCondition($category, $subcategory, $name){
		global $conn;
		$stmt = $conn->prepare(" SELECT avg(condition) AS average FROM item_instances, items, subcategories, categories
			WHERE item_instances.id_item = items.id AND items.name = ? AND items.id_subcategory = subcategories.id AND subcategories.name = ? AND subcategories.id_category = categories.id AND categories.name = ?;");
		$stmt->bindValue(1, $name, PDO::PARAM_STR);
		$stmt->bindValue(2, $subcategory, PDO::PARAM_STR);
		$stmt->bindValue(3, $category, PDO::PARAM_STR);

		$stmt->execute();
		$result = $stmt->fetch();
		return $result['average'];
	}

	function updateItemState($state, $category, $subcategory, $item){
		global $conn;
		$stmt = $conn->prepare("UPDATE items SET removed = ? WHERE items.id = (SELECT items.id FROM items, subcategories, categories WHERE items.name = ? AND items.id_subcategory = subcategories.id AND subcategories.name = ? AND subcategories.id_category = categories.id AND categories.name = ?);");
		$stmt->bindValue(1, $state, PDO::PARAM_BOOL);
		$stmt->bindValue(2, $item, PDO::PARAM_STR);
		$stmt->bindValue(3, $subcategory, PDO::PARAM_STR);
		$stmt->bindValue(4, $category, PDO::PARAM_STR);

		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	function deleteReservation($name, $end_date, $today, $instance){
		global $conn;
		$stmt = $conn->prepare("DELETE FROM reservations USING users WHERE reservations.id_client = users.id AND users.username = :name AND reservations.start_time <= :today AND reservations.end_time >= :end AND reservations.id_item_instance = :instance;");
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->bindValue(':today', $today, PDO::PARAM_STR);
		$stmt->bindValue(':end', $end_date, PDO::PARAM_STR);
		$stmt->bindValue(':instance', $instance, PDO::PARAM_INT);

		return $stmt->execute();
	}

	function lendItem($instance, $manager, $id_client, $end_date){
		global $conn;
		$stmt = $conn->prepare("INSERT INTO item_history_records (id_item_instance, id_inventory_manager, type) VALUES (:instance, :manager, 'Lend') RETURNING id;");
		$stmt->bindValue(':instance', $instance, PDO::PARAM_INT);
		$stmt->bindValue(':manager', $manager, PDO::PARAM_INT);

		$result = $stmt->execute();
		$id = $stmt->fetch();
		$id = $id['id'];

		$stmt = $conn->prepare("INSERT INTO lend_records (id, id_client, end_date) VALUES (:id, :id_client, :data);");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->bindValue(':id_client', $id_client, PDO::PARAM_INT);
		$stmt->bindValue(':data', $end_date, PDO::PARAM_STR);
		return $stmt->execute();
	}

	function getUserWhoLent($instance, $type){
		global $conn;
		$stmt = $conn->prepare("SELECT id FROM item_history_records WHERE id_item_instance = :instance AND type = 'Lend' ORDER BY date DESC LIMIT 1");
		$stmt->bindValue(':instance', $instance, PDO::PARAM_INT);

		$stmt->execute();
		$idHistory = $stmt->fetch()['id'];

		$stmt = $conn->prepare("SELECT id_client FROM lend_records WHERE id = :id;");
		$stmt->bindValue(':id', $idHistory, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch()['id_client'];
	}

	function returnItem($instance, $idManager, $id_client){
		global $conn;
		$stmt = $conn->prepare("INSERT INTO item_history_records (id_item_instance, id_inventory_manager, type) VALUES (:instance, :manager, 'Return') RETURNING id;");
		$stmt->bindValue(':instance', $instance, PDO::PARAM_INT);
		$stmt->bindValue(':manager', $idManager, PDO::PARAM_INT);
		$stmt->execute();
		$id = $stmt->fetch();
		$id = $id['id'];

		$stmt = $conn->prepare("INSERT INTO return_records (id, id_client) VALUES (:id, :id_client);");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->bindValue(':id_client', $id_client, PDO::PARAM_INT);
		return $stmt->execute();
	}

	function maintenance($instance, $manager, $repairer, $end_date){
		global $conn;
		$stmt = $conn->prepare("INSERT INTO item_history_records (id_item_instance, id_inventory_manager, type) VALUES (:instance, :manager, 'Maintenance') RETURNING id;");
		$stmt->bindValue(':instance', $instance, PDO::PARAM_INT);
		$stmt->bindValue(':manager', $manager, PDO::PARAM_INT);
		$stmt->execute();
		$id = $stmt->fetch();
		$id = $id['id'];

		$stmt = $conn->prepare("INSERT INTO maintenance_records (id, repairer, expected_end) VALUES (:id, :repairer, :end);");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->bindValue(':repairer', $repairer, PDO::PARAM_STR);
		$stmt->bindValue(':end', $end_date, PDO::PARAM_STR);
		return $stmt->execute();
	}

	function repaired($instance, $manager){
		global $conn;
		$stmt = $conn->prepare("INSERT INTO item_history_records (id_item_instance, id_inventory_manager, type) VALUES (:instance, :manager, 'Repaired');");
		$stmt->bindValue(':instance', $instance, PDO::PARAM_INT);
		$stmt->bindValue(':manager', $manager, PDO::PARAM_INT);
		$stmt->execute();
	}