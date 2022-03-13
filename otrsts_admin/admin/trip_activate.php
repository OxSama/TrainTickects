<?php
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE trips SET status=:status WHERE id=:id");
			$stmt->execute(['status'=>1, 'id'=>$id]);
			$_SESSION['success'] = 'Trip activated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Select Trip to activate first';
	}

	header('location: trains.php');
?>