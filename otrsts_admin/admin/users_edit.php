<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$ssn = $_POST['ssn'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM customers WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($password == $row['password']){
			$password = $row['password'];
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		try{
			$stmt = $conn->prepare("UPDATE customers SET ssn=:ssn, email=:email, password=:password, firstname=:firstname, lastname=:lastname, address=:address, contact_info=:contact WHERE id=:id");
			$stmt->execute(['ssn'=>$ssn, 'email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'address'=>$address, 'contact'=>$contact, 'id'=>$id]);
			$_SESSION['success'] = 'customer updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit customer form first';
	}

	header('location: users.php');

?>