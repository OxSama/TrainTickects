<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$name           = $_POST['name'];
        $status         = $_POST['status'];
		$dist1          = $_POST['d1'];
		$dist2          = $_POST['d2'];
		$price          = $_POST['price'];
        $Time1          = strtotime($_POST['DepartureTime1']);
        $DepartureTime1 = date('g:i a' , $Time1 );
        $Time2          = strtotime($_POST['DepartureTime2']);
        $DepartureTime2 = date('g:i a' , $Time2 );
        $Time3          = strtotime($_POST['ArrivalTime1']);
        $Time4          = strtotime($_POST['ArrivalTime2']);
        $ArrivalTime1   = date('g:i a' , $Time3 );
        $ArrivalTime2   = date('g:i a' , $Time4 );
	

		try{
			$stmt = $conn->prepare("UPDATE trains SET id=:name, status=:status WHERE id=:id");
			$stmt->execute(['name'=>$name, 'status'=>$status,  'id'=>$name]);





			 $stmt1 = $conn->prepare("UPDATE stations SET name=:name,status=:status,created_on= :created_on, ticket_point=:ticket_point,going_dep_time=:going_dep_time, return_arr_time=:return_arr_time 
			 	WHERE train_id= :train_id and root = 1 ORDER BY id ASC LIMIT 1 ");
				    
				     $stmt1->execute(['name'=>$dist1 ,'status'=>$status, 'created_on'=>$now, 'ticket_point'=>1, 
				     	'going_dep_time'=>$DepartureTime1, 'return_arr_time'=> $ArrivalTime2,
				     	'train_id'=>$name]);




				    $stmt2 = $conn->prepare("UPDATE stations SET name=:name,status=:status,created_on= :created_on,  ticket_point=:ticket_point,going_arr_time=:going_dep_time, return_dep_time=:return_arr_time
			 	               WHERE train_id= :train_id and root = 1 ORDER BY id DESC LIMIT 1");


				   $stmt2->execute(['name'=>$dist2 ,'status'=>$status, 'created_on'=>$now, 'ticket_point'=>1, 
				     	'going_dep_time'=>$DepartureTime2, 'return_arr_time'=> $ArrivalTime1,
				     	'train_id'=>$name  ]);

			$_SESSION['success'] = 'train updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit train form first';
	}

	header('location: trains.php');

?>