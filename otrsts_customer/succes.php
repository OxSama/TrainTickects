<?php
	include 'includes/session.php';

	if(isset($_POST['pay'])){

		$customer = $_POST['id'];
		
		  

		$conn = $pdo->open();

		
			try{
				$stmt1 = $conn->prepare("SELECT * from passingers where customer_id = :customer order by id desc limit 1");
				$stmt1->execute(['customer'=>$customer]);

				foreach ($stmt1 as $row) {

					 echo $row['ticket_id'];
					
				}
                            



				








                   
                     
                  




				

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up passinger form first';
	}
                    
	//header("location:passengerPaymentDetailes.php?id=$customer&trip=$trip&price=$price&from=$from&to=$to&a_time=$a_time&d_time=$d_time");

?>