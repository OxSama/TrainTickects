<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

        $stmt7 = $conn->prepare("SELECT * FROM stations WHERE train_id = ? and root=1");
                      $stmt7->execute(array($id));
        $stmt = $conn->prepare("SELECT trains.id ,trains.status , price.id as p, price.price, price.dist1,price.dist2 ,price.train_id from trains inner join price on trains.id = price.train_id and trains.id = :id order by price.id asc LIMIT 1 ");
		//$stmt = $conn->prepare("SELECT * FROM trains WHERE id=:id ");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>