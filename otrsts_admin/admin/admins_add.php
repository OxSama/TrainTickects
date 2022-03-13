<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$ssn      = $_POST['ssn'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$status = $_POST['status'];
		$role = $_POST['role'];
		$gender = $_POST['gender'];


		$conn = $pdo->open();




//1 admin 2 staff 0 customer





		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email=:email");
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
				$stmt = $conn->prepare("INSERT INTO users ( email, password, firstname, lastname, address, contact_info, photo, status, role, created_on, gender) VALUES ( :email, :password, :firstname, :lastname, :address, :contact, :photo, :status, :role, :created_on, :gender)");
				$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'address'=>$address, 'contact'=>$contact, 'photo'=>$filename, 'status'=>$status, 'role'=>$role, 'created_on'=>$now,'gender'=>$gender]);
				$_SESSION['success'] = 'Admin added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

















		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up form first';
	}

	header('location: admins.php');

?>