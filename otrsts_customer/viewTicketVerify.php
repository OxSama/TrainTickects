<?php
	include 'includes/session.php';
	$conn = $pdo->open();

	if(isset($_POST['view'])){
        $id = $_GET['id'];
		$ticketId = $_POST['ticketId'];


		try{

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM passingers WHERE ticket_id=?");
            $stmt->execute(array($ticketId));
					$row = $stmt->fetch();
			if($row['numrows'] > 0){
										header("Location: viewTicketDetails.php?ticket=$ticketId");
										// $_SESSION['success'] = 'Ticket found';


			}
				
				
			else{
				$_SESSION['error'] = 'Ticket ID not found';
			}

	        
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = 'Input Ticket ID  first';
	}

	$pdo->close();

	header("Location: index.php?id=$id");

?>