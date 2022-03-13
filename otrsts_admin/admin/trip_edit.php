<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id             = $_POST['id'];
		$status         = $_POST['status'];
	    $now            = strtotime($_POST['DepatureDate']);
	    $DepatureDate   = date('Y-m-d' ,$now);
	    $path           = $_POST['path'];
        $train_id       = $_POST['trainid'];
         
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM trips WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		

		try{
			$stmt = $conn->prepare("UPDATE trips SET train_id=:train_id ,trip_date=:trip_date, 
				 	trip_path=:trip_path, status=:status WHERE id=:id");


	   $stmt->execute(['train_id'=>$train_id ,'trip_date'=>$DepatureDate, 'trip_path'=>$path , 'status'=>$status ,'id'=>$id]);

			$_SESSION['success'] = 'trip updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up trip station form first';
	}

	header("location: tripsDetails.php?id=$train_id");

?>