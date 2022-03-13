<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['user'])){
		header('location: index.php');
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; 

        

	?>
	 

		 <?php
						 $id = $_GET['id'];
						 $train_id = $_GET['train_id'];
                    $conn = $pdo->open();
                            try{
                    
                       $stmt1 = $conn->prepare("SELECT trips.id as trip, trips.train_id ,trips.trip_date,trains.* from trips inner join trains on trips.train_id =trains.id and trips.train_id = :train_id
                                                limit 1 ");
                      $stmt1->execute(['train_id'=>$train_id]);
                   
                       
                      }
                    
                    catch(PDOException $e){
                      echo $e->getMessage();
           } ?> <?php
           
                    $pdo->close();
                  ?>

	  <div class="content-wrapper">
	    <div class="container">

	   

	        					<?php foreach ($stmt1 as $row ) { 
                                    $stmt11 = $conn->prepare("SELECT trains.id as train , classes.*  from trains inner join classes on trains.id =classes.train_id and trains.id = :train_id");
                      $stmt11->execute(['train_id'=>$row['train_id']]);
	        						?>

	        						   <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-15">
	        		<div class="box box-solid">
	        			<div class="box-body">
							<br><br>
	        				<div class="col-sm-3">

	        					<img src="<?php echo (!empty($row['photo'])) ? './images/'.$row['photo'] : './images/train2.png'; ?>" width="100%">
	        				</div>
	        				<div class="col-sm-9">
	        					<div class="row">
	        						<div class="col-sm-4">
	        							<h4>Train Number :</h4>
	        							<h4>Trip No :</h4>
	        							<h4>Date :</h4>
	        							<h4>Classes :</h4>
	        							


	        						</div>
	        						<div class="col-sm-8">
	        							<h4><?php echo $row['train_id']; ?>
	        								<!-- <span class="pull-right">
	        									<a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
	        								</span> -->
	        							</h4>
	        							<h4><?php echo $row['trip']; ?></h4>
	        							<h4><?php echo $row['trip_date']; ?></h4>
	        							<h4><?php 
                                                   foreach ($stmt11 as $row1) {
                                                   echo $row1['name'] .'  '. $row1['price'].'  '.$row1['description'].' / ';
                                                   }
	        							 ?></h4>
	        							
										<br>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>

					


	        	</div>
	        	
	        	
	        </div>
			
	      </section>
	     
	        						
	        					<?php } ?>
	        					
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