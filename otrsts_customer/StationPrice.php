<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
                     $dist1 = $_POST['station_id'] ;
                     $train_id = $_POST['id'] ;
                      
                for ($i=0; $i < count($_POST['price']) ; $i++) { 
                	$s_price[$i] = $_POST['price'][$i];
                	$dist2[$i]  = $_POST['distnation'][$i];
                	//echo $dist2[$i];


                      
                         $conn = $pdo->open();

			try{


			
				   $stmt3 = $conn->prepare("INSERT INTO price ( price ,dist1 , dist2, train_id)
                    VALUES (:price,:dist1, :dist2, :train_id)");


				     $stmt3->execute(['price'=>$s_price[$i] ,'dist1'=>$dist1, 'dist2'=>$dist2[$i],'train_id'=>$train_id]); 

				       $stmt3 = $conn->prepare("INSERT INTO price ( price ,dist1 , dist2, train_id)
                    VALUES (:price,:dist1, :dist2, :train_id)");


				     $stmt3->execute(['price'=>$s_price[$i] ,'dist1'=>$dist2[$i], 'dist2'=>$dist1,'train_id'=>$train_id]); 



				$_SESSION['success']= 'First station details added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();
	}  

                	 }

//                	}





                	
                
		  
		/*$price = $_POST['price'];
        $train_id = $_POST['id'];
          
         $dist1 = '';
         $dist2 = '';




		$conn = $pdo->open();

			try{


				$stmt = $conn->prepare("SELECT stations.train_id, stations.name, stations.id as station , trains.id from stations inner join trains on stations.train_id = trains.id and trains.id = train_id and root = 1 order by station asc limit 1");
				$stmt->execute(['train_id'=>$train_id]);
                
    
                $stmt1 = $conn->prepare("SELECT stations.train_id, stations.name, stations.id as station , trains.id from stations inner join trains on stations.train_id = trains.id and trains.id = train_id and root = 1 order by station desc limit 1");
 

				     $stmt1->execute(['train_id'=>$train_id]);
                           
                            foreach ($stmt as $row) {
                            	$dist1 = $row['station'];
                            }


                            foreach ($stmt1 as $row1) {
                            	$dist2 = $row1['station'];
                            }



  //$train_id = $_GET['id'];

				    $stmt3 = $conn->prepare("INSERT INTO price ( price ,dist1 , dist2, train_id)
                    VALUES (:price,:dist1, :dist2, :train_id)");


				     $stmt3->execute(['price'=>$price ,'dist1'=>$dist1, 'dist2'=>$dist2,'train_id'=>$train_id]); 



				$_SESSION['success']= 'First Train details added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();
	}  */
	
	else{
		$_SESSION['error'] = 'Fill up station first details form first';
	}

	header('location: trains.php');

?>




<!-- 
<script type="text/javascript">
	$(window).on('load',function(){

$('#myModal2').modal('show');
	});
</script> -->
