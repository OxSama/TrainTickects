<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$train_id = $_POST['trainid'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
	

		try{
			$stmt = $conn->prepare("UPDATE classes SET name=:name, description=:description, price=:price WHERE id=:id");
			$stmt->execute(['name'=>$name, 'description'=>$description, 'price'=>$price  ,'id'=>$id]);
			$_SESSION['success'] = 'class updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit class form first';
	}

	header("location: seats.php?id=$train_id");

?>