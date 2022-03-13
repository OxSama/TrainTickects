<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$status = $_POST['status'];
		$TicketPoin     = $_POST['TicketPoint'];
         $Time1          = strtotime($_POST['DepartureTime1']);
        $DepartureTime1 = date('g:i a' , $Time1 );
        $Time2          = strtotime($_POST['DepartureTime2']);
        $DepartureTime2 = date('g:i a' , $Time2 );
        $Time3          = strtotime($_POST['ArrivalTime1']);
        $Time4          = strtotime($_POST['ArrivalTime2']);
        $ArrivalTime1   = date('g:i a' , $Time3 );
        $ArrivalTime2   = date('g:i a' , $Time4 );
        $price          = $_POST['price'];
        $train_id       = $_POST['trainid'];
         
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM stations WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		

		try{
			$stmt = $conn->prepare("UPDATE stations SET name=:name ,status=:status , 
				 	ticket_point=:ticketpoin, going_dep_time=:going_dep_time, going_arr_time=:going_arr_time, 
				 	return_dep_time=:return_dep_time, return_arr_time = :return_arr_time, train_id=:train_id  WHERE id=:id");


			$stmt->execute(['name'=>$name, 'status'=>$status,'ticketpoin'=>$TicketPoin,
				'going_dep_time'=>$DepartureTime1, 'going_arr_time'=>$ArrivalTime1 ,'return_dep_time'=>$DepartureTime2,
				'return_arr_time'=>$ArrivalTime2 , 'train_id'=>$train_id ,'id'=>$id]);

			$_SESSION['success'] = 'station updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit station form first';
	}

	header('location: trains.php');

?>