<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$status = $_POST['status'];
		$role = $_POST['role'];
		
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		
		try{
			$stmt = $conn->prepare("UPDATE users SET status=:status, role=:role WHERE id=:id");
			$stmt->execute(['status'=>$status, 'role'=>$role, 'id'=>$id]);
			$_SESSION['success'] = ' updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit one form first';
	}

	header('location: admins.php');

?>