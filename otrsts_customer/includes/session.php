<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['user'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id and role = 0");
			$stmt->execute(['id'=>$_SESSION['user']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close(); 
	}

	else if(isset($_SESSION['staff'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id and role = 2");
			$stmt->execute(['id'=>$_SESSION['staff']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close(); 
	}
?>