<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php';
	 
	 if(isset($_SESSION['user'])||isset($_SESSION['staff'])){
	   $id = $_GET['id'];
	 }

	 else{

			   $id = '';

	 }
	  	?>
	 
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
						if(isset($_SESSION['success'])){
							echo "
							  <div class='callout callout-success text-center'>
								<p>".$_SESSION['success']."</p> 
							  </div>
							";
							unset($_SESSION['success']);
						  }
	        		?>
	        		<!-- <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/banner1.png" alt="First slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/banner2.png" alt="Second slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/banner3.png" alt="Third slide">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div> -->
	        		<div class="box box-solid">
	        			<div class="box-body">
						<h1 class="page-header">Trips Routes</h1>

		        		<table class="table table-bordered">
		        			<thead>
		        				<th>Train Number</th>
		        				<th>Route</th>
		        				<th >Ticket pay Stations</th>
								<th >Stop at Stations</th>


		        			</thead>
		        			<tbody>
		        				              <?php
                    $conn = $pdo->open();
                     try{
                    


                       $stmt = $conn->prepare("SELECT * from trains");
                      $stmt->execute(array());
                  
                     //  $stmt1 = $conn->prepare("SELECT stations.* , trains.id as train from stations inner join trains on 
                       //	stations.train_id = trains.id and trains.id = :id and root = 1 ");
                      //$stmt1->execute(['id'=>$row['train']]);
                     foreach($stmt as $row){ 
                       
                        $stmt11 = $conn->prepare("SELECT stations.* , trains.id as train from stations inner join trains on 
                       	stations.train_id = trains.id and trains.id = :id and root = 1 order by stations.id asc limit 1 ");
                      $stmt11->execute(['id'=>$row['id']]);

                       $stmt12 = $conn->prepare("SELECT stations.* , trains.id as train from stations inner join trains on 
                       	stations.train_id = trains.id and trains.id = :id and root = 1  order by stations.id desc limit 1 ");
                      $stmt12->execute(['id'=>$row['id']]);

                           
                   ?>

                          <tr>
                          	<td><?php echo $row['id']?></td>

                          	<td><?php foreach($stmt11 as $row11){ 
                                 echo $row11['name']; }
                          		?><i class='fa fa-arrows-h'></i><?php foreach($stmt12 as $row12){ 
                                 echo $row12['name']; }
                          		?></td>

								<td><select class='form-control'> 
									<?php
					  $stmt1 = $conn->prepare("SELECT stations.* , trains.id as train from stations inner join trains on 
                       	stations.train_id = trains.id and trains.id = :id and ticket_point = 1 ");
                      $stmt1->execute(['id'=>$row['id']]);
									foreach($stmt1 as $row1){ ?>
									<option ><?php echo $row1['name']; }?> </option>
								</td>
								<td><select class='form-control'> 
									<?php
					  $stmt1 = $conn->prepare("SELECT stations.* , trains.id as train from stations inner join trains on 
                       	stations.train_id = trains.id and trains.id = :id ");
                      $stmt1->execute(['id'=>$row['id']]);
									foreach($stmt1 as $row1){ ?>
									<option ><?php echo $row1['name']; }?> </option>
								</td>
                     
                          
                          
                          </tr>
                      <?php
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
           } ?> <?php
           
                    $pdo->close();
                  ?>
								

								
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>	
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>