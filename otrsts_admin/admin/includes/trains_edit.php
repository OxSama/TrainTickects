<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$status = $_POST['status'];
		
	

		try{
			$stmt = $conn->prepare("UPDATE trains SET name=:name, status=:status WHERE id=:id");
			$stmt->execute(['name'=>$name, 'status'=>$status,  'id'=>$id]);
			$_SESSION['success'] = 'train updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit train form first';
	}

	header('location: trains.php');

?>