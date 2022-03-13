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
						<h1 class="page-header">Search for Trips</h1>
						 <?php
						 $id = $_GET['id'];
                    $conn = $pdo->open();
                            try{
                    
                       $stmt1 = $conn->prepare("SELECT DISTINCT name 
                                              FROM stations WHERE ticket_point = 1
                                                ");
                      $stmt1->execute(array());
                   
                        $stmt2 = $conn->prepare("SELECT DISTINCT name 
                                              FROM stations
                                                ");
                      $stmt2->execute(array());   
                      }
                    
                    catch(PDOException $e){
                      echo $e->getMessage();
           } ?> <?php
           
                    $pdo->close();
                  ?>
						<form id="manage-filter"  action="availableTrips.php?id=<?php echo $id ?>" method="POST" >
							<input type="hidden" name="customer" value="<?php echo $id ?>">
                                    <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label for="" class="col-sm-3 control-label">From</label>
                                            <select name="station1" id="departure" class="form-control" required>
											<option></option>

                                            	<?php foreach ($stmt1 as $row) {?>
                                                <option value="<?php echo $row['name']?>"><?php echo $row['name']?></option>
												
                                                        <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="" class="col-sm-7 control-label">To</label>
                                            <select name="station2" id="arrival" class="form-control" required>
											<option></option>

											<?php foreach ($stmt2 as $row2) {?>
                                                <option value="<?php echo $row2['name']?>"><?php echo $row2['name']?></option>
												
                                                        <?php } ?>

                                               

                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="" class="col-sm-3 control-label">Day</label>
                                            <input type="date" class="form-control" name="date" autocomplete="off" min="<?php echo date('Y-m-d');?>">
                                        </div>
                         <br>
                                        <div class="col-sm-3 offset-sm-3">
										<button type="submit" class="btn btn-primary btn-flat" name="available"><i class="fa fa-search"></i> Find trip</button>
                                        </div>

                                     
                                        
                                    </div>

									
                                </form>
						</div>
					</div>


					

<?php
if(1==5){

?>
					<!-- trip search end  -->
	        		<div class="box box-solid">
	        			<div class="box-body">
						<h1 class="page-header">Trips Available</h1>

		        		<table class="table table-bordered">
		        			<thead>
							<th>Train Name</th>

		        				<th>Departure Time</th>
                                <th>Arrival Time</th>
                                <th width="30%">Class Type : Price</th>
								<th></th> 

								

		        			</thead>
		        			<tbody>

							<td></td>
								<td></td>
								<td></td>
								<td><select class='form-control'><option >Busniss class : 2000 SDG</option ><option >Common class : 1000 SDG</option></select></td>
								<td width="20%">

								<a href='trainMoreDetails.php?' class='btn btn-info btn-sm btn-flat'><i class='fa fa-search'></i> More Detailes</a>

								<!-- <button class='btn btn-primary btn-sm edit btn-flat' data-id=''><i class='fa fa-search'></i> Book now</button> -->
								
								
								<?php
								if(isset($_SESSION['user'])){

                                ?>
								
								<a href='passengerDetailes.php?' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-ticket'></i> Book now</a>

								<!-- <button class='btn btn-primary btn-sm edit btn-flat' data-id=''><i class='fa fa-search'></i> Book now</button> -->
								</td>
								<?php
								}?>

								
		        			</tbody>
		        		</table>
	        			
	        		<?php
	        			if(!isset($_SESSION['user'])){
							// header('location: passengerDetailes.php');
							echo "
							<h4>You need to <a href='login.php'>Login</a> to book your ticket.</h4>
						";
	        			}
	        			// else{
	        			// 	echo "
	        			// 		<h4>You need to <a href='login.php'>Login</a> to book your tickets.</h4>
	        			// 	";
	        			// }
	        		?>
					</div>
	        		</div>


					<?php
					}
					else if (false){
					?>
<div class="box box-solid">
	        			<div class="box-body">
						<center><h1 >Sorry! No Trips Available</h1></center>
						</div></div>
						<?php
						}
						?>






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