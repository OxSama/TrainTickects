<?php include 'includes/session.php'; ?>
<?php
	if(!(isset($_SESSION['user'])||isset($_SESSION['staff']))){
		header('location: index.php');
	}
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
	        	<div class="col-sm-12">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='callout callout-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}

	        			if(isset($_SESSION['success'])){
	        				echo "
	        					<div class='callout callout-success'>
	        						".$_SESSION['success']."
	        					</div>
	        				";
	        				unset($_SESSION['success']);
	        			}
	        		?>
	        		<div class="box box-solid">
	        			<div class="box-body">
	        				<div class="col-sm-3">
	        					<img src="<?php echo (!empty($user['photo'])) ? './images/'.$user['photo'] : '../images/user.jpg'; ?>" width="100%">
	        				</div>
	        				<div class="col-sm-9">
	        					<div class="row">
	        						<div class="col-sm-4">
	        							<h4>Name :</h4>
	        							<h4>Email :</h4>
	        							<h4>Contact Info :</h4>
	        							<h4>Address :</h4>
	        							<h4>Member Since :</h4>
	        						</div>
	        						<div class="col-sm-8">
	        							<h4><?php echo $user['firstname'].' '.$user['lastname']; ?>
	        								<span class="pull-right">
	        									<a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
	        								</span>
	        							</h4>
	        							<h4><?php echo $user['email']; ?></h4>
	        							<h4><?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/a'; ?></h4>
	        							<h4><?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h4>
	        							<h4><?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="box box-solid">
	        			<div class="box-header with-border">
	        				<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Past Bookings</b></h4>
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered" id="example1">
							<thead>
							<th>Trip Date</th>

				  <th>Trip No.</th>
                  <th>Ticket ID</th>
                  <th>Passenger Name</th>
				  <th>Booking Date</th>



                </thead>
	        					<tbody>
	        					<?php
                    $conn = $pdo->open();
                    $payment;
                    $qrcode;

                    try{
                      $stmt = $conn->prepare("SELECT users.id ,passingers.trip_id,passingers.firstname ,passingers.ticket_id as ticket_ID, passingers.created_on,passingers.qrcode,trips.trip_date FROM(( passingers INNER JOIN users on users.id=passingers.customer_id) INNER JOIN trips on trips.id=passingers.trip_id) WHERE users.id=? AND passingers.created_on != CURRENT_DATE");
                      $stmt->execute(array($user['id']));
                      foreach($stmt as $row){
                        $qrcode=$row['qrcode'];
                       
                        
                        echo "
                          <tr>
                            <td>".date('M d, Y', strtotime($row['trip_date']))."</td>
                            <td>".$row['trip_id']."</td>
                            <td>".$row['ticket_ID']."</td>
                            <td>".$row['firstname']."</td>
							<td>".date('M d, Y', strtotime($row['created_on']))."</td>



                          
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
	        					</tbody>
	        				</table>
	        			</div>
	        		</div>

					<div class="box box-solid">
	        			<div class="box-header with-border">
	        				<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Upcoming Trips</b></h4>
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered" id="example1">
							<thead>
							<th>Trip Date</th>

				  <th>Trip No.</th>
                  <th>Ticket ID</th>
                  <th>Passenger Name</th>
                  <th>Booking Status</th>
				  <th>Booking Date</th>


                </thead>
	        					<tbody>
	        					<?php
                    $conn = $pdo->open();
                    $payment;
					$tic;
                    $qrcode;

                    try{
                      $stmt = $conn->prepare("SELECT users.id ,passingers.trip_id,passingers.firstname ,passingers.ticket_id as ticket_ID, passingers.created_on,passingers.qrcode,trips.trip_date FROM(( passingers INNER JOIN users on users.id=passingers.customer_id) INNER JOIN trips on trips.id=passingers.trip_id) WHERE users.id=? AND passingers.created_on >= CURRENT_DATE");
                      $stmt->execute(array($user['id']));
                      foreach($stmt as $row){
                        $qrcode=$row['qrcode'];
                        if($qrcode!=NULL){
                          $payment="<strong><span style='color: green;'>Paid</span></strong>";
						  $tic=$row['ticket_ID'];
                        }
                        else if($qrcode==NULL){

							$payment="<strong><span style='color: red;'>Booked</span></strong>";

							
								if(isset($_SESSION['user'])){

                                
						//   $payment.="&nbsp;&nbsp;&nbsp;&nbsp;<a href='payment.php?id=".$row['id']."&price=' class='btn btn-info btn-sm btn-flat'><i class='fa fa-credit-card'></i> Pay</a>";
						  $tic="<a href='payment.php?id=".$row['id']."&price=500' class='btn btn-info btn-sm btn-flat'><i class='fa fa-credit-card'></i> Pay</a>&nbsp;&nbsp;&nbsp;&nbsp; to get Ticket ID";
								}
								else if (isset($_SESSION['staff'])){
						  $tic="<a href='completePayment.php?id=".$row['id']."&ticket=".$row['ticket_ID']."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-money'></i> Submit</a>&nbsp;&nbsp;&nbsp;&nbsp; to get Ticket ID";
								}
                        }
                        
                        echo "
                          <tr>
						  <td>".date('M d, Y', strtotime($row['trip_date']))."</td>
						  <td>".$row['trip_id']."</td>
						  <td>".$tic."</td>
						  <td>".$row['firstname']."</td>
						  <td>".$payment." </td>
						  <td>".date('M d, Y', strtotime($row['created_on']))."</td>


                          
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
	        					</tbody>
	        				</table>
	        			</div>
	        		</div>


	        	</div>
	        	<!-- <div class="col-sm-3">
					sidebar
	        	</div> -->
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/profile_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$(document).on('click', '.transact', function(e){
		e.preventDefault();
		$('#transaction').modal('show');
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'transaction.php',
			data: {id:id},
			dataType: 'json',
			success:function(response){
				$('#date').html(response.date);
				$('#transid').html(response.transaction);
				$('#detail').prepend(response.list);
				$('#total').html(response.total);
			}
		});
	});

	$("#transaction").on("hidden.bs.modal", function () {
	    $('.prepend_items').remove();
	});
});
</script>
</body>
</html>