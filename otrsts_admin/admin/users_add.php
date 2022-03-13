<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];

		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$ssn = $_POST['ssn'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$gender   = $_POST['gender'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM customers WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Email already taken';
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			$filename = $_FILES['photo']['name'];
			$now = date('Y-m-d');
			if(!empty($filename)){
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
			}
			try{
				$stmt = $conn->prepare("INSERT INTO customers ( email, password, firstname, lastname, address, contact_info, photo,  created_on , gender) VALUES (:email, :password, :firstname, :lastname, :address, :contact, :photo, :created_on, :gender)");
				$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'address'=>$address, 'contact'=>$contact, 'photo'=>$filename, 'gender'=>$gender, 'created_on'=>$now]);
				$_SESSION['success'] = 'User added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up customer form first';
	}

	header('location: users.php');

?>