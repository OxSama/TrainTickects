<?php
	include 'includes/session.php';
     
	if(isset($_POST['add'])){

		$name           = $_POST['name'];
		$status         = $_POST['status'];
	    $now            = date('Y-m-d');
	    $TicketPoin     = $_POST['TicketPoint'];
        $Time1          = strtotime($_POST['DepartureTime1']);
        $DepartureTime1 = date('H:i:s' , $Time1 );
        $Time2          = strtotime($_POST['DepartureTime2']);
        $DepartureTime2 = date('H:i:s' , $Time2 );
        $Time3          = strtotime($_POST['ArrivalTime1']);
        $Time4          = strtotime($_POST['ArrivalTime2']);
        $ArrivalTime1   = date('H:i:s' , $Time3 );
        $ArrivalTime2   = date('H:i:s' , $Time4 );
        $price          = $_POST['price'];
        $id             = $_POST['trainid'];


		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM stations WHERE name=:name and train_id = :id");
		$stmt->execute(['name'=>$name,'id'=>$id]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'this station name already taken, try new station name';
		}
		else{

			try{

                      
				 $stmt = $conn->prepare("INSERT INTO stations ( name ,status , created_on, 
				 	ticket_point, going_dep_time, going_arr_time, return_dep_time, return_arr_time,train_id )
                     VALUES (:name,:status, :created_on, :ticket_point, :going_dep_time, :going_arr_time,:return_dep_time,:return_arr_time, :train_id)");


				     $stmt->execute(['name'=>$name ,'status'=>$status, 'created_on'=>$now, 'ticket_point'=>$TicketPoin , 
				     	'going_dep_time'=>$DepartureTime1, 'going_arr_time'=>$ArrivalTime1,
				     	 'return_dep_time'=> $DepartureTime2,  'return_arr_time'=> $ArrivalTime2,'train_id'=>$id]);
				$_SESSION['success'] = 'First Station details added successfully, you have to add price to complete the addition operation';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up station first details form first';
	}

	header("location: stations_modal3.php?id=$id&station=$name");

?>