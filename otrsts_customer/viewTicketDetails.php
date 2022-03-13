<?php include 'includes/session.php'; 
						$id = $_GET['id'];
						?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	<div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-15">
					<!-- trip search begin -->
	        	

            <br>



            <div class="container-fluid">
	<div class="col-md-3">
		
	</div>
	<div class="col-md-6">
	
		<div class="panel panel-default">
			<div class="panel-body">
			 
			 <br />
			 <div class="panel panel-success">
			 	<div class="panel-heading">
			 		<h3 class="panel-title"><center>Ticket details</center></h3>
			 	</div>
			 	<div class="panel-body">

			 		<strong>
			 			<i><h4>Sudan Railways</h4></i><br>
</strong>




<!-- <input type="hidden" class="qr" name="qr"> -->


<?php
                    $conn = $pdo->open();
$qr;
                    try{
                      $ticket_no = $_GET['ticket'];
                      $stmt = $conn->prepare("SELECT * FROM passingers WHERE ticket_id=?");
                      $stmt->execute(array($ticket_no));
					  
                      foreach($stmt as $row){



						$qr=$row['qrcode'];


						  echo '<img src="'.$row['qrcode'].'" />';
                            
                         
						?>

<input type="hidden" name="qr" value="<?php echo $qr?>">

                         <h4>
			 			Ticket ID : <?php echo $ticket_no?>
			 			 </h4><br>

						 <strong>
			 				Passenger Name :</strong> Leena Tarig Abdallah Abdalgader
			 			<br><br>
			 			<h3>
			 			khartoum
			 			 - 
						Atbara
			 			 </h3><br>
			 			<p><strong>Departure Date: 2022-2-28 @8:00:AM</strong></p>
			 		</strong>
			 			<i>Estimated Arrival Time: 2022-2-28 @3:15:PM</i><br><br>
			 			
						 <strong>
			 				Class Type :</strong> Second Class
			 			<br><br>
						 <strong>
			 				Capin No :</strong> 550
			 			<br><br>
                         <strong>
			 				Seat No :</strong> 26
			 			<br><br>
						 <strong>
			 				Amount :</strong> 3500 SDG
			 			<br><br>
                         <strong>
			 				Customer :</strong> razan hasan
			 			<br><br>


<?php

					}

					}
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>



						
			 	</div>
			 </div>
<center>
			 <button type="submit" class="btn btn-success btn-flat" name="print"><span class="glyphicon glyphicon-print"></span> Print</button>
</center> 
			</form>



            </div>
			
            <div class="modal-footer">
						</div>
					</div>
					<!-- trip search end  -->
	        		
	        	
	        	
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>
<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>





<?php include 'includes/scripts.php'; ?>
</body>
</html>