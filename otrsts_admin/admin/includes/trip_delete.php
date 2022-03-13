<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		if ($id !='') {
			$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM trips WHERE id=:id");

			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Trip deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
			
		
		}
		
		
	}
	else{
		$_SESSION['error'] = 'Select Trip to delete first';
	}

	header('location: trains.php');
	
?>