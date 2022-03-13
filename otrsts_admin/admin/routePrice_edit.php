<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$train_id = $_POST['trainid'];
		
		$price = $_POST['price'];
	

		try{
			$stmt = $conn->prepare("UPDATE Price SET  price=:price WHERE id=:id");
			$stmt->execute(['price'=>$price, 'id'=>$id]);
			$_SESSION['success'] = 'Route Price updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit Route Price form first';
	}

	header("location: ticketPoint.php?id=$train_id");

?>