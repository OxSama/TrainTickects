<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['add'])){//if1
		$subject = $_POST['subject'];
		$message = $_POST['message'];
$emR;
$now = date('Y-m-d');

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT COUNT(id) AS numrows FROM passingers WHERE trip_id=?");
        $stmt->execute(array());
        foreach($stmt as $row){ //foreach1
            $emR=$row['numrows'];
            }//foreach1
		// $row = $stmt->fetch();

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
                    $stmt2 = $conn->prepare("SELECT email FROM passingers INNER JOIN users on users.id=passingers.customer_id;");
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

                   

                    $_SESSION['success'] = 'message sent';
                






                    try{
$stmt3 = $conn->prepare("INSERT INTO notifications (name, subject,created_on) VALUES (:subject,:message,:created_on)");
                    $stmt3->execute(['subject'=>$subject,'message'=>$message,'created_on'=>$now]);
                        $_SESSION['success'] = 'Announcement Added successfully';
        
                    }
                    catch(PDOException $e){
                        $_SESSION['error'] = $e->getMessage();
                    }









                    
                                
                }//try2
                catch (Exception $e) {
                    $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                }

                    


            }//try1
            catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
        }//if2
		else{//else2
			$_SESSION['error'] = 'There is no customers(emails) joined yet';
		}//else2

		$pdo->close();

	}//if1
	else{//else1
		$_SESSION['error'] = 'Fill up announcement form first';
	}//else1




	header('location: announcements.php');

?>