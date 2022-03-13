<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$train_id = $_POST['trainid'];
		$name = $_POST['className'];
		$description = $_POST['classDescription'];
		$price  = $_POST['price'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM classes WHERE name=:name and train_id=:train_id");
		$stmt->execute(['name'=>$name, 'train_id'=>$train_id]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'This class already taken';
		}
		else{
			
			try{
				$stmt = $conn->prepare("INSERT INTO classes (name, description, price, train_id) VALUES (:name,:description,:price,:train_id)");
				$stmt->execute(['name'=>$name,'description'=>$description,'price'=>$price,'train_id'=>$train_id]);
				$_SESSION['success'] = 'Class added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up class form first';
	}

	header("location: seats.php?id=$train_id");

?>