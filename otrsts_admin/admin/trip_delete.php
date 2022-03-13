<?php
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['delete'])){//if1
		$train_id = $_POST['trainid'];

		$id = $_POST['id'];
		$subject = "TRIP WAS CANCELLED";
		$message = "We are very sorry for trip cacelling, please contact with us for more details";
		$emR;
		$now = date('Y-m-d');

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT COUNT(id) AS numrows FROM passingers WHERE trip_id=?");
        $stmt->execute(array($id));
		foreach($stmt as $row){ 
            $emR=$row['numrows'];
            }





			if($emR > 0){//if2
				try{//try1
					//Load phpmailer
					require '../vendor/autoload.php';
	
					$mail = new PHPMailer(true);                             
					try {//tr2
						//Server settings
						$mail->isSMTP();                                     
						$mail->Host = 'smtp.gmail.com';                      
						$mail->SMTPAuth = true;  
						$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead                             
						$mail->Username = 'otrsts2021@gmail.com';     
						$mail->Password = 'SudanRailways';                    
						$mail->SMTPOptions = array(
							'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
							)
						);                         
						$mail->SMTPSecure = 'ssl';                           
						$mail->Port = 465;                                   
						$stmt2 = $conn->prepare("SELECT email FROM passingers INNER JOIN customers on customers.id=passingers.customer_id;");
						$stmt2->execute(array());
						$mail->setFrom('otrsts2021@gmail.com','Sudan Railways');
	//Content
	$mail->isHTML(true);                                  
	$mail->Subject = $subject;
	$mail->Body    = $message;
						foreach($stmt2 as $row2){  
	
						//Recipients
						$mail->addAddress($row2['email']);              
						$mail->addReplyTo('otrsts2021@gmail.com','Sudan Railways');
					
						
	
						$mail->send();
						 //Clear all addresses and attachments for the next iteration
		$mail->clearAddresses();
		$mail->clearAttachments();
						}//foreach
	
	
						// $_SESSION['success'] = 'message sent';
				   
	
						
									
					}//try2
					catch (Exception $e) {
						// $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
					}
	
						
	
	
				}//try1
				catch(PDOException $e){
					// $_SESSION['error'] = $e->getMessage();
				}
			}//if2



			$pdo->close();














/////////////////emmmmmaaaaaail




		if ($id !='') {//if2
			$conn = $pdo->open();

		try{//try1
			$stmt = $conn->prepare("DELETE FROM trips WHERE id=:id");

			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Trip deleted successfully';
		}//try1
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}//catch1

		$pdo->close();
			
		
		}//if2
		
		
	}//if1
	else{//else if1
		$_SESSION['error'] = 'Select Trip to delete first';
	}//else if1

	header("location: tripsDetails.php?id=$train_id");
	
?>