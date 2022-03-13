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
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	     


<div class="container-fluid">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-body">
			 <h2>
			 	<center>ACCOMODATION</center>
			 </h2>
				<div class="container-fluid">
					<form class="form-horizontal" role="form" id="form-acc">
					  <table id="myTable-party" class="table table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
							    <tr>
							        <th> <span class="glyphicon glyphicon-record" aria-hidden="true"></span> 
							        Accomodation
							        </th>
							        <th>
							        	<center>
							        		Slots
							        	</center>
						        	</th>
							        <th>
							        	<center>
							        		Fare
							        	</center>
						        	</th>
							    </tr>
							</thead>
						    <tbody>
						   		<tr>
						   			<td>
						   				<input  type="radio" name="acc">
						   			</td>
						   			<td align="center">
						   			</td>
						   		</tr>
						   		<tr>
						   			<td>
						   				<input  type="radio" name="acc">
						   				<?= $getEcoA['acc_type']; ?>
						   			</td>
						   			<td align="center">
						   				<?= $getEcoA['acc_slot'] - $totalEcoA['ecoA']; ?>
						   			</td>
						   			<td align="center"><?= $getEcoA['acc_price']; ?></td>
						   		</tr>
						   		<tr>
						   			<td>
						   				<input value= type="radio" name="acc">
						   				<?= $getEcoB['acc_type']; ?>
						   			</td>
						   			<td align="center">
						   				<?= $getEcoB['acc_slot'] - $totalEcoB['ecoB']; ?>
						   			</td>
						   			<td align="center"><?= $getEcoB['acc_price']; ?></td>
						   		</tr>
						   		<tr>
						   			<td>
						   				<input value="<?= $getTour['acc_id']; ?>" type="radio" name="acc">
						   				<?= $getTour['acc_type']; ?>
						   			</td>
						   			<td align="center">
						   				<?= $getTour['acc_slot'] - $totalTour['ecoT']; ?>
						   			</td>
						   			<td align="center"><?= $getTour['acc_price']; ?></td>
						   		</tr>
						   		<tr>
						   			<td>
						   				<input value="<?= $getCab['acc_id']; ?>" type="radio" name="acc">
						   				<?= $getCab['acc_type']; ?>
						   			</td>
						   			<td align="center">
						   				<?= $getCab['acc_slot'] - $totalCab['ecoC']; ?>
						   			</td>
						   			<td align="center"><?= $getCab['acc_price']; ?></td>
						   		</tr>
						   		<tr>
						   			<td>
						   				<input value="<?= $getDel['acc_id']; ?>" type="radio" name="acc">
						   				<?= $getDel['acc_type']; ?>
						   			</td>
						   			<td align="center">
						   				<?= $getDel['acc_slot'] - $totalDel['ecoD']; ?>
						   			</td>
						   			<td align="center"><?= $getDel['acc_price']; ?></td>
						   		</tr>
						    </tbody>
					    </table>
				      <div class="form-group">
					    <label for="">Total # of Passenger:</label>
					    <input type="number" min="1" class="form-control" name="totalPass" plactreholder="Total # of Passenger" autocomplete="off">
					  </div>
					  <button type="submit" class="btn btn-success">NEXT
					  <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
					  </button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>




		       	
	        	</div>
	        	
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
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