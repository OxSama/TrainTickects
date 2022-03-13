<?php
	include 'includes/session.php';
     
	if(isset($_POST['add'])){

		
		$status         = $_POST['status'];
	    $now            = strtotime($_POST['DepatureDate']);
	    $DepatureDate   = date('Y-m-d' ,$now);
	    $path           = $_POST['path'];
        $id             = $_POST['trainid'];


		$conn = $pdo->open();
		/*$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM trips WHERE DepatureDate=:name and train_id = :id");
		$stmt->execute(['name'=>$DepatureDate, 'id'= $train_id]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'trip already taken';
		}
		else{
*/
			try{

                      
				 $stmt = $conn->prepare("INSERT INTO trips ( train_id ,trip_date , trip_path, status)
                     VALUES (:train_id, :trip_date, :trip_path, :status)");


				     $stmt->execute(['train_id'=>$id ,'trip_date'=>$DepatureDate, 'trip_path'=>$path , 'status'=>$status]);
				      $_SESSION['success'] = 'trip added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		//}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up station form first';
	}

	header("location: tripsDetails.php?id=$id");

?>