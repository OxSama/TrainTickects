<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$train_id = $_POST['trainid'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM classes WHERE id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'class deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select class to delete first';
	}

	header("location: trains.php");
	
?>