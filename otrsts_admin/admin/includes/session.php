<?php
	include '../includes/conn.php';
	session_start();

	if((!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '' ) && (!isset($_SESSION['staff']) || trim($_SESSION['staff']) == '' )){
		header('location: ../index.php');
		exit();
	}
if (isset($_SESSION['admin'])) {
 	

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id and role = 1");
	$stmt->execute(['id'=>$_SESSION['admin']]);
	$admin = $stmt->fetch();

	$pdo->close();
}


if(isset($_SESSION['staff'])){

	
		$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id and role = 2");
	$stmt->execute(['id'=>$_SESSION['staff']]);
	$admin = $stmt->fetch();

	$pdo->close();
	}
?>