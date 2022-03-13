<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$train_id = $_POST['trainid'];
		$num = $_POST['num'];
		$classname = $_POST['classname'];
		$seatsno = $_POST['seatsno'];
		$status = $_POST['status'];
		
	

		try{
			$stmt = $conn->prepare("UPDATE train_trailers SET trailer_num=:num, seats_no=:seatsno, class_id=:classname, train_id=:train_id, status=:status WHERE id=:id");
			$stmt->execute(['num'=>$num, 'seatsno'=>$seatsno, 'classname'=>$classname, 'train_id'=>$train_id  , 'status'=>$status, 'id'=>$id]);
			$_SESSION['success'] = 'class updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit class form first';
	}

	header('location: trains.php');

?>