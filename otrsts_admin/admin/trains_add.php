<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name           = $_POST['name'];
        $status         = $_POST['status'];
		$dist1          = $_POST['d1'];
		$dist2          = $_POST['d2'];
		$price          = $_POST['price'];
        $Time1          = strtotime($_POST['DepartureTime1']);
        $DepartureTime1 = date('H:i:s' , $Time1 );
        $Time2          = strtotime($_POST['DepartureTime2']);
        $DepartureTime2 = date('H:i:s' , $Time2 );
        $Time3          = strtotime($_POST['ArrivalTime1']);
        $Time4          = strtotime($_POST['ArrivalTime2']);
        $ArrivalTime1   = date('H:i:s' , $Time3 );
        $ArrivalTime2   = date('H:i:s' , $Time4 );
        $now            = date('Y-m-d');
          






		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM trains WHERE id=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'this train number already taken, try new train number';

		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			$filename = $_FILES['photo']['name'];
			//$now = date('Y-m-d');
			if(!empty($filename)){
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
			}
			try{
				$stmt = $conn->prepare("INSERT INTO trains (id, status, photo,  created_on ) VALUES (:name,:status, :photo, :created_on)");
				$stmt->execute(['name'=>$name,'status'=>$status,  'photo'=>$filename, 'created_on'=>$now]);
                
    
                $stmt1 = $conn->prepare("INSERT INTO stations ( name ,status , created_on, root, ticket_point, going_dep_time, return_arr_time,train_id )
                    VALUES (:name,:status, :created_on, :root, :ticket_point, :going_dep_time, :return_arr_time, :train_id)");
 

				     $stmt1->execute(['name'=>$dist1 ,'status'=>$status, 'created_on'=>$now, 'root'=>1, 'ticket_point'=>1, 
				     	'going_dep_time'=>$DepartureTime1, 'return_arr_time'=> $ArrivalTime1,
				     	'train_id'=>$name]);

				     $stmt2 = $conn->prepare("INSERT INTO stations ( name ,status , created_on, root, ticket_point, going_arr_time, return_dep_time,train_id )
                    VALUES (:name,:status, :created_on, :root, :ticket_point, :going_arr_time, :return_dep_time, :train_id)");


				     $stmt2->execute(['name'=>$dist2 ,'status'=>$status, 'created_on'=>$now, 'root'=>1, 'ticket_point'=>1, 
				     	'going_arr_time'=>$ArrivalTime2, 'return_dep_time'=> $DepartureTime2,
				     	'train_id'=>$name]);

				    /*  $stmt3 = $conn->prepare("INSERT INTO price ( price ,dist1 , dist2, train_id)
                    VALUES (:price,:dist1, :dist2, :train_id)");


				     $stmt3->execute(['price'=>$price ,'dist1'=>$dist1, 'dist2'=>$dist2,'train_id'=>$name]); */




				$_SESSION['success']= 'First Train details added successfully, you have to add price to complete the addition operation';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up train first details form first';
	}

	header("location: trains_modal3.php?id=$name");

?>




<!-- 
<script type="text/javascript">
	$(window).on('load',function(){

$('#myModal2').modal('show');
	});
</script> -->
