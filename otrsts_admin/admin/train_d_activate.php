<?php
	include 'includes/session.php';

	if(isset($_POST['activate'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE train_trailers SET status=:status WHERE id=:id");
			$stmt->execute(['status'=>1, 'id'=>$id]);
			$_SESSION['success'] = 'trailer activated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
      // header('location: trainDetails.php?id='.$id.'');
	}
	else{
		$_SESSION['error'] = 'Select trailer to activate first';
	}

	header('location: trains.php');
?>