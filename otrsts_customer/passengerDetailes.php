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
	        		<div class="box box-solid">
	        			<div class="box-body" >
                        <h1 class="page-header"><center><strong>Fill Passenger Details</strong></center></h1><br>

						<!--  -->

						<?php
						//for($i=0;$i<=2;$i++){

						
						?>


						 <?php
						 $id = $_GET['id'];
						 $trip_id = $_GET['trip_id'];


						 $price=$_GET['price'];
						 $from =$_GET['from'];
						 $to = $_GET['to'];
						 $a_time = $_GET['a_time'];
						 $d_time = $_GET['d_time'];


                    $conn = $pdo->open();
                            try{
                    
                     
                         $stmt6 = $conn->prepare("SELECT trips.*, classes.id as cn,classes.name,classes.train_id 
                           	,classes.price FROM trips inner join classes on trips.train_id = classes.train_id 
                           	and trips.id = :trip_id");


				     $stmt6->execute(['trip_id'=>$trip_id]);  
                   
                       
                      }
                    
                    catch(PDOException $e){
                      echo $e->getMessage();
           } ?> <?php
           
                    $pdo->close();
                  ?>

						<form class="form-horizontal" method="POST" action="passinger_add.php" enctype="multipart/form-data">
							<input type="hidden" name="customer" value="<?php echo $id?>">
							<input type="hidden" name="trip" value="<?php echo $trip_id?>">
							<input type="hidden" name="price" value="<?php echo $price?>">
							<input type="hidden" name="from" value="<?php echo $from?>">
							<input type="hidden" name="to" value="<?php echo $to?>">
							<input type="hidden" name="a_time" value="<?php echo $a_time?>">
							<input type="hidden" name="d_time" value="<?php echo $d_time?>">

            <br>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Full Name</label>

                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter passenger full name" required>
                    </div>
                </div>
                 <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Gender</label>
                <br>
                    <div class="col-sm-6">
                      <input type="radio"  id="female" name="gender" required checked=""  value="1">Female
                      <input type="radio"  id="male" name="gender" required  value="0">Male
                    </div>
                  </div>
                    
                    <br>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Age</label>

                    <div class="col-sm-6">
                      <input type="number" class="form-control" id="age" name="age" placeholder="Enter passenger age" required>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-6">
                      <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter passenger contact info" required>
                    </div>
                </div>



                <!-- <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Proof passenger identity by:</label>

                    <div class="col-sm-6">
                    <select class='form-control'name="identityType">
                                     

                                     	<option value="passport">Passport Number</option >
										 <option value="id">National Identification Number</option >

                                   
									</select>
                                      </div>
                </div>
 <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Identity Number</label>

                    <div class="col-sm-6">
                      <input type="number" class="form-control" id="identityNo" name="identityNo" placeholder="Enter passenger identity number" required>
                    </div>
                </div> -->
                <br>

                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Class Type</label>

                    <div class="col-sm-6">
                    <select class='form-control'name="classname">
                                     <?php foreach ($stmt6 as $row) { ?>

                                     	<option value="<?php echo $row['cn']?>"><?php echo $row['name'] ;?> Class</option >
                                   <?php  } ?>
									</select>
                                      </div>
                </div>

                <br>
				<div class="modal-header"></div>
				<br><br>

				<?php
					//	}
?>
            </div>



			<!--  -->


            <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-flat" name="next"><i class="glyphicon glyphicon-arrow-right"></i> Next</button>

            <!--<a href='passengerPaymentDetailes.php?' class='btn btn-primary btn-flat'> Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>-->

              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</button>
              <!-- <button type="submit" class="btn btn-primary btn-flat" name="add"> Next <i class="fa fa-arrows"></i></button> -->
              </form>
						</div>
					</div>
					<!-- trip search end  -->
	        		
	        	
	        	</div>
	        	
	        </div>
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