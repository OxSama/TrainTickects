<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM train_trailers WHERE id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'trailer deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select trailer to delete first';
	}

	header('location: trains.php');
	
?>