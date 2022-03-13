<?php include 'includes/session.php'; ?>
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
	        	 		 <?php
						 $id = $_GET['id'];
						 $trip = $_GET['trip'];
						 $price=$_GET['price'];
						 $from =$_GET['from'];
						 $to = $_GET['to'];
						 $a_time = $_GET['a_time'];
						 $d_time = $_GET['d_time'];
						 $date = '';
						 $a_time = date ('H:i:A',strtotime($a_time));
						 $d_time = date ('H:i:A',strtotime($d_time));


                    $conn = $pdo->open();
                            try{
                    
                       $stmt1 = $conn->prepare("SELECT passingers.*,classes.id as cn, classes.name as class from passingers inner join classes on passingers.class_id = classes.id and customer_id = :customer_id 
                       	order by id desc limit 1");
                      $stmt1->execute(['customer_id'=>$id]);


                                 $stmt2 = $conn->prepare("SELECT * from trips where id = :trip");
                      $stmt2->execute(['trip'=>$trip]);
                   
                          foreach ($stmt2 as $row) {
                          	$date = $row['trip_date'];
                          }


                       
                      }
                    
                    catch(PDOException $e){
                      echo $e->getMessage();
           } ?> <?php
           
                    $pdo->close();
                  ?>


                  <?php foreach ($stmt1 as $row) { ?>


                  	<form class="form-horizontal" method="POST" action="payment.php?id=<?php echo $id?>&price=<?php echo $price?>" enctype="multipart/form-data">
            <br>


			
			<!-- <strong>Notice!</strong> Please complete your ticket reservation, to get your Ticket ID.<br> -->


            <div class="container-fluid">
	<div class="col-md-3">
		
	</div>
	<div class="col-md-6">
	<div class="alert alert-warning" >
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Be careful !</strong> you must pay your ticket at most after 3 hours from booking it. 
		</div>


		<div class="panel panel-default">
			<div class="panel-body">
			 <h3>
			 	<center>Passenger Ticket Reservation Detailes</center>
			 </h3>
			 <br />
			 <div class="panel panel-primary">
			 	<div class="panel-heading">
			 		<h3 class="panel-title"><center>Reservation</center></h3>
			 	</div>
			 	<div class="panel-body">
			 		<strong>
			 			<i><h4>Sudan Railways</h4></i><br>

						 <strong>
			 				Passenger Name : <?php echo $row['firstname'];?>
			 			</strong><br><br>
			 			<h3>
			 			<?php echo $from?>
			 			 - 
						<?php echo $to?>
			 			 </h3><br>
			 			<p>Departure Date: <?php echo $date ?> @<?php echo $d_time?></p>
			 		</strong>
			 			<i>Estimated Arrival Time: <?php echo $date ?> @<?php echo $a_time?></i><br><br>
			 			
						 <strong>
			 				Class Type : <?php echo $row['class']; ?> Class
			 			</strong><br><br>
						 
						 <strong>
			 				Amount : <?php echo $price ?> SDG
			 			</strong><br><br>
						
			 	</div>
			 </div>


                <br><br>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</button>
			  <?php
								if(isset($_SESSION['user'])){

                                ?>
             <button type="submit" class="btn btn-success btn-flat" name="add"><i class="fa fa-credit-card"></i> Pay  </button>
			 <?php
								}?>  
			 <?php 
			 if(isset($_SESSION['staff'])){
				 ?>
				<a href='staffPayment.php?id=<?php echo $_GET['id']?>&price=<?php echo $price?>' class="btn btn-primary btn-flat"> Submit <span  class="fa fa-money" aria-hidden="true"></span></a>
<?php
			 }
			 ?>
			
			</form>
                  	
                <?php  } ?>

						
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

<script type="text/javascript">
	$(document).on('submit', '#form-itinerary', function(event) {
		event.preventDefault();
		/* Act on the event */
		var validate = "";
		var origin = $('select[id=orig-id]').val();
		var dest = $('select[id=dest-id]').val();
		var dept = $('input[id=dept-date]').val();

		if(dept.length == 0){
			alert('Please Select Departure Date!');
		}else{
			$.ajax({
					url: 'data/session_itinerary.php',
					type: 'post',
					dataType: 'json',
					data: {
						oid : origin,
						did : dest,
						dd : dept
					},
					success: function (data) {
						console.log(data);
						if(data.valid == true){
							window.location = data.url;
							console.log('sss');
						}
					},
					error: function(){
						alert('Error: L161+');
					}
				});
		}//end dept kung == 0


	});

</script>


<?php include 'includes/scripts.php'; ?>
</body>
</html>