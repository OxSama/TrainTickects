<?php
	include 'includes/session.php';
     
	if(isset($_POST['add'])){
		$train_id = $_POST['trainid'];
		$number = $_POST['num'];
		$classname = $_POST['classname'];
		//$fs = $_POST['fs'];
		//$ls = $_POST['ls'];
		$status = $_POST['status'];
		$seats_no = $_POST['seatsno'];
		

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM train_trailers WHERE trailer_num=:num and train_id = :id ");
		$stmt->execute(['num'=>$number, 'id'=>$train_id]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'trailer already taken';
		}
		else{
			
			try{
				$stmt = $conn->prepare("INSERT INTO train_trailers (trailer_num, seats_no, class_id, train_id, status) 
					VALUES (:num, :seats_no, :classname, :train_id, :status)");
				$stmt->execute(['num'=>$number, 'seats_no'=>$seats_no, 'classname'=>$classname,'train_id'=>$train_id, 'status'=>$status]);
				$_SESSION['success'] = 'trailer added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
		header("location: trainDetails.php?id=$train_id");
	}
	else{
		$_SESSION['error'] = 'Fill up trailer form first';
	}

	//header('location: trainDetails.php?id="'.$_GET['id'].'"');

?>