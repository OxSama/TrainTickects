<?php
	include 'includes/session.php';

	if(isset($_POST['next'])){
		
		$customer = $_POST['customer'];
		$trip = $_POST['trip'];
		$name = $_POST['name'];
        $gender   = $_POST['gender'];
		$age = $_POST['age'];
		$contact = $_POST['contact'];
		$classname = $_POST['classname'];
		$ticket_id = rand() ;
		$seat = '' ;
		$avalable_seat = 0;
	    $now  = date('Y-m-d');
	    $price = $_POST['price'];
	    $from  = $_POST['from'];
	    $to   = $_POST['to'];
	    $a_time  = $_POST['a_time'];
	    $d_time  = $_POST['d_time'];
		  

		$conn = $pdo->open();

		
			try{
				$stmt1 = $conn->prepare("SELECT trips.id as trip, train_trailers.id ,trips.train_id , train_trailers.seats_no, 
					                             train_trailers.train_id , train_trailers.class_id 
					                     from trips
					                      inner join train_trailers
					                       on 
					                             trips.train_id = train_trailers.train_id 
					                              and train_trailers.class_id = :classname ");
				$stmt1->execute(['classname'=>$classname]);

				     foreach ($stmt1 as $row) {

					$avalable_seat = $avalable_seat + $row['seats_no'];


                    $stmt2 = $conn->prepare("SELECT passingers.*, train_trailers.id , train_trailers.seats_no, 
					                                train_trailers.train_id , train_trailers.class_id 
					                         from passingers 
					                          inner join train_trailers
					                           on 
					                                passingers.class_id = train_trailers.class_id 
					                                and train_trailers.class_id = :classname ");
				    $stmt2->execute(['classname'=>$classname]);

				    $count= $stmt2->rowCount();
					 
					$avalable_seat = $avalable_seat - $count;
					// $ticket_id = $ticket_id +1;
 
                      
					//echo $count;
                      
					//echo $avalable_seat;

				}

                    if ($avalable_seat > 0 ) {
                        // echo "string";   
                      $stmt = $conn->prepare("INSERT INTO passingers 
                 	                                      (customer_id, firstname, age, contact_info, created_on,	gender,	ticket_id, trip_id, seat_no, class_id)
                 	                          VALUES
                 	                                       (:customer_id, :firstname, :age, :contact_info, :created_on, :gender, :ticket_id, :trip_id, :seat_no , :class_id)");


				    $stmt->execute(['customer_id'=>$customer,'firstname'=>$name, 'age'=>$age, 'contact_info'=>$contact,
				                    'created_on'=>$now, 'gender'=>$gender, 'ticket_id'=>$ticket_id, 'trip_id'=>$trip, 
				                    'seat_no'=>$avalable_seat, 'class_id'=>$classname]);       
                  
                   $ticket_id = $ticket_id +1;

                            //  echo $avalable_seat;
                     }
                                   	//$_SESSION['success'] = 'User added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up passinger form first';
	}
                    
	// header("location:passengerPaymentDetailes.php?id=$customer&trip=$trip&price=$price&from=$from&to=$to&a_time=$a_time&d_time=$d_time");

?>