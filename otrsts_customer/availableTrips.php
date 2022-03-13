<?php
   include 'includes/session.php'; 
 include 'includes/header.php';  ?>
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
	        				<!--<<div class="box box-solid">
	        					<div class="box-body" >
								<h1 class="page-header">Search for Trips</h1>-->
							<div class="box box-solid">
	        					<div class="box-body">
									<h1 class="page-header">Trips Available</h1>
										<?php
											if(isset($_POST['available'])){
       											$date1 = $_POST['date'];
      											// echo $date1;
       											$trip_date = strtotime($date1);
												$from         = $_POST['station1']; 
	    										$to           = $_POST['station2'];
	    										$d_time = '';
	    										$a_time = '';
												$from_id = '';
												$to_id = '';
												// $id             = $_POST['trainid'];
												$trip_price ='';
												$count = '';
												$conn = $pdo->open();
												$id = $_GET['id'];
												/*$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM trips WHERE DepatureDate=:name and train_id = :id");
												$stmt->execute(['name'=>$DepatureDate, 'id'= $train_id]);
												$row = $stmt->fetch();
												if($row['numrows'] > 0){
													$_SESSION['error'] = 'trip already taken';
												}
												else{
												*/
												try{
													//' '.$row['name'].' '. '-'
                   									$path = ' '.$from.' '.'-'.' '.$to.' '.'-';      
                									/*  $stmt1 = $conn->prepare("SELECT trips.*, stations.id as st , stations.name,stations.train_id , stations.going_dep_time,stations.going_arr_time,stations.return_dep_time,stations.return_arr_time FROM trips inner join stations on trips.train_id = stations.train_id and trip_path = :trip_path and (stations.name = :d1 or stations.name = :d2) order by stations.id asc limit 1");
													$stmt1->execute(['trip_path'=>$path,'d1'=>$from ,'d2'=>$to]);  
                    								            foreach ($stmt1 as $row) {
                    								            	$from_id = $row['st'];
                    								            	if ($row['name'] = $from) {
                    								            		 $d_time = $row['going_dep_time'];
                    								            	}
                    								              	if ($row['name'] = $to) {
                    								              		$d_time = $row['return_dep_time']; 
                    								              	}
                    								            }
                    								            $stmt1 = $conn->prepare("SELECT trips.*, stations.id as st , stations.name,stations.train_id , stations.going_dep_time,stations.going_arr_time,stations.return_dep_time,stations.return_arr_time FROM trips inner join stations on trips.train_id = stations.train_id and trip_path = :trip_path and (stations.name = :d1 or stations.name = :d2) order by stations.id desc limit 1");
				    								 			$stmt1->execute(['trip_path'=>$path,'d1'=>$from ,'d2'=>$to]);
                    								            foreach ($stmt1 as $row) {
                    								                $to_id = $row['st'];
                    								              	if ($row['name'] = $from) {
                    								              		$a_time = $row['return_arr_time'];
                    								              	}
                    								              	if ($row['name'] = $to) {
                    								              		$a_time = $row['going_arr_time']; 
                    								              	}
                    								            }
                    								    		$stmt5 = $conn->prepare("SELECT trips.*, price.* 
																FROM trips 
																inner join price 
																on trips.train_id = price.train_id 
																and trip_path = :trip_path and (price.dist1 = :d1 or :d2) 
                    								    		or (price.dist1 = :d1 or :d2) order by price.id asc limit 1");
				    								 			$stmt5->execute(['trip_path'=>$path,'d1'=>$from_id ,'d2'=>$to_id]);  
                    								         	foreach ($stmt5 as $row) {
													            	$trip_price = $row['price'];
                    								            }*/
//////////////////////////////////////////////////////////// NEW BY OX
													//////////////////////////////////  BY OX
													$fromStationQuery = $conn->prepare("SELECT DISTINCT stations.id FROM stations WHERE stations.name = :d1");
													$fromStationQuery->execute(['d1'=>$from]);
													// $fromStationQuery->debugDumpParams();

													$station1data = $fromStationQuery->fetchAll(PDO::FETCH_ASSOC);
													// echo 'hi';
													$toStationQuery = $conn->prepare("SELECT DISTINCT stations.id FROM stations WHERE stations.name = :d2");
													// echo 'hi again';
													$toStationQuery->execute(['d2'=>$to]);
													// echo'hi here';
													// $toStationQuery->debugDumpParams();

													$station2data = $toStationQuery->fetchAll(PDO::FETCH_ASSOC);

													$train_ids =[];
													$trains_counter=0;
													// print_r($station1data);
													// echo '<br>';
													foreach($station1data as $dist1){
														// print_r($dist1);
														// echo('<br>');
														foreach($station2data as $dist2){
															// print_r($dist2);
															$priceQuery= $conn->prepare("SELECT price.train_id FROM price WHERE price.dist1 = :d1 and price.dist2 = :d2");
															$priceQuery->execute(['d1'=>$dist1['id'],'d2'=>$dist2['id']]);
															if ($priceQuery->rowCount() > 0) {
																// ... got results ...
																foreach($priceQuery->fetchAll(PDO::FETCH_ASSOC) as $one_train_id){
																	// print_r($one_train_id);
																	$train_ids[$trains_counter]=$one_train_id['train_id'];
																	$trains_counter++;
																}
															  } else {
																//  echo 'nothing';
															  }
														}
													}
													

													// print_r($data);
													// print_r($data);
													$newcounter = 0;
													$morequery='';
													if(empty($train_ids)){
														die('No Trips Available');
													}
													foreach($train_ids as $data1){
														// print_r($data1);
														if($newcounter==0){
															$morequery .= "WHERE (( trips.train_id = ".$data1."  ) and (stations.name = '".$from."' ))";
															// if(sizeof($data)-1==$newcounter){
															// 	$morequery .= " ) ";
															// }
														}else{
															$morequery .= " (( trips.train_id = ".$data1."  ) and (stations.name = '".$from."' ))";
														}
														if(!(sizeof($train_ids)-1==$newcounter)){
															$morequery .= " OR ";
														}
														// else
														// {
														// 	$morequery .= " or stations.train_id = ".$data1['train_id'];
														// }
														// ' الخرطوم - مدني -
														// '
														$newcounter++;
													}
													//////////////////////////////// BY OX
													// echo "SELECT DISTINCT trips.*,stations.* FROM trips join stations on trips.train_id = stations.train_id  ".$morequery;
													/////////////////////////////////////////////////////////// BY OX
														// $stmt = $conn->prepare("SELECT DISTINCT trips.*,stations.* FROM trips join stations on trips.train_id = stations.train_id WHERE ".$morequery);
													////////////////////////////////////////////////////////// BY OX
													// echo 'hi';	
													// print_r($stmt);

													$stmt = $conn->query("SELECT DISTINCT trips.*,stations.* FROM trips join stations on trips.train_id = stations.train_id  ".$morequery);
													// $stmt->debugDumpParams();
													
													// $stmt->execute();
													print_r($stmt);
													echo '<br>';
													$stmt->debugDumpParams();
													// echo'hi12';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////NEW BY OX
														if ($date1 == '') {
															$count = $stmt->rowCount();
				   											// echo  $count .  $path ;
				   										if ($count > 0) {
                   										    foreach ($stmt as $row) { 
                   										    	$stmt6 = $conn->prepare("SELECT trips.*, classes.id as cn,classes.name,classes.train_id 
                   										       	,classes.price FROM trips inner join classes on trips.train_id = classes.train_id
                   										       	and classes.train_id = :id");
				   										        $stmt6->execute(['id'=>$row['train_id']]);  
				   										        $stmt1 = $conn->prepare("SELECT * from stations where train_id = :id and name = :name");
				   										 		$stmt1->execute(['id'=>$row['train_id'],'name'=>$from]);  
                   										        foreach ($stmt1 as $row1) {$from_id = $row1['id']; }
                   										        $stmt2 = $conn->prepare("SELECT * from stations where train_id = :id and name = :name");
                   										        $stmt2->execute(['id'=>$row['train_id'],'name'=>$to]);
                    										       foreach ($stmt2 as $row2) { $to_id = $row2['id']; }
																$stmt5 = $conn->prepare("SELECT price.* ,trips.* from price inner join trips on price.train_id = trips.train_id  and
                   										      	((price.dist1 = :d1 or :d2) and  (price.dist2 = :d1 or :d2)) and price.train_id = :id limit 1");
				   										 		$stmt5->execute(['d1'=>$from_id ,'d2'=>$to_id,'id'=>$row['train_id']]);  
                   										        foreach ($stmt5 as $row5) {$trip_price = $row5['price'];}
                   										        $count1 = $stmt5->rowCount();
                   										        if ($count1 >0) {
                   										    	//  $currnt_trip = $row['trip_date'];
                   										    	/*  $date2 = strtotime($currnt_trip);
                          										if($date1 <= $date2){ echo "llllllllll";*/
                        									?>  
                             										<!-- trip search end  -->
		        											<table class="table table-bordered">
		        												<thead>
																	<th>Train Number</th>
																	<th>Trip Date</th>
																	<th>Departure Time</th>
																	<th>Arrival Time</th>
																	<th width="30%">Class Type : Price</th>
																	<th></th> 
		        												</thead>
		        												<tbody>
																    <td><?php echo $row['train_id']?></td>
																	<td><?php echo $row['trip_date']?></td>
																	<td><?php echo $d_time  ?></td>
																	<td><?php echo $a_time  ?></td>
																	<td>
																		<select class='form-control'>
                                     										<?php 
																			foreach ($stmt6 as $row) {
																				$p = $row['price'] + $trip_price; ?>
                                     											<option value="<?php echo $row['cn']?>"><?php echo $row['name'].' class : '.'price : '.$p?></option >
                                   											<?php  } ?>
																		</select>
																	</td>
																	<td width="20%">
																		<a href='trainMoreDetails.php?id=<?php echo $id ?>&train_id=<?php echo $row['train_id'] ?>' class='btn btn-info btn-sm btn-flat'><i class='fa fa-search'></i> More Detailes</a>
																		<!-- <button class='btn btn-primary btn-sm edit btn-flat' data-id=''><i class='fa fa-search'></i> Book now</button> -->
																		<?php
																		if(isset($_SESSION['user']) || isset($_SESSION['staff']) ){
					                    					            ?>
																		<a href='passengerDetailes.php?id=<?php echo $id ?>&trip_id=<?php echo $row['id'] ?>&price=<?php echo $p ?>&from=<?php echo $from?>&to=<?php echo $to?>&d_time=<?php echo $d_time?>&a_time=<?php echo $a_time?>' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-ticket'></i> Book now</a>
																		<!-- <button class='btn btn-primary btn-sm edit btn-flat' data-id=''><i class='fa fa-search'></i> Book now</button> -->
																	</td>
																	<?php
																		} /*}
																	elseif ($date1 > $date2) {
																	 	echo "string";
																	 } */?>
																</tbody>
		        											</table>
										<?php
										}   // else echo "string";
                                    }
										?>
	        							<?php
	        							if(!isset($_SESSION['user'])|| isset($_SESSION['staff']) ){
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
								else if ($count==0){
							?>
							<div class="box box-solid">
	        					<div class="box-body">
									<center><h1 >Sorry! No Trips Available</h1></center>
								</div>
							</div>
							<?php
										} 
									}
                                    elseif ($date1 != '') {
										$stmt23 = $conn->prepare("SELECT trips.*,stations.* FROM trips inner join stations on trips.train_id = stations.train_id and ((stations.name = :d1 or stations.name = :d2 )and trip_date = :trip_date)");
										$stmt23->execute(['d1'=>$from , 'd2'=>$to, 'trip_date'=>$date1]);
										if ($stmt23->rowCount() == 0) {
				     		?>
							<div class="box box-solid">
	        					<div class="box-body">
									<center><h1 >Sorry! No Trips Available</h1></center>
								</div>
							</div>
							<?php
							}
							foreach ($stmt23 as $row) {
								$stmt6 = $conn->prepare("SELECT trips.*, classes.id as cn,classes.name,classes.train_id 
                           		,classes.price FROM trips inner join classes on trips.train_id and classes.train_id = :id");
								$stmt6->execute(['id'=>$row['train_id']]);
								$stmt1 = $conn->prepare("SELECT * from stations where train_id = :id and name = :name");
								$stmt1->execute(['id'=>$row['train_id'],'name'=>$from]);
								foreach ($stmt1 as $row1) {
                                	$from_id = $row1['id']; 
								}
								$stmt2 = $conn->prepare("SELECT * from stations where train_id = :id and name = :name");
								$stmt2->execute(['id'=>$row['train_id'],'name'=>$to]);  
								foreach ($stmt2 as $row2) {
                                	$to_id = $row2['id'];
								}
                          		$stmt5 = $conn->prepare("SELECT price.* ,trips.* from price inner join trips on price.train_id = trips.train_id  and
                          		((price.dist1 = :d1 or :d2) and  (price.dist2 = :d1 or :d2)) and price.train_id = :id limit 1");
								$stmt5->execute(['d1'=>$from_id ,'d2'=>$to_id,'id'=>$row['train_id']]);  
                             	foreach ($stmt5 as $row5) {
                             	    $trip_price = $row5['price'];
                             	}
                       			//  $currnt_trip = $row['trip_date'];
                        		/*  $date2 = strtotime($currnt_trip);
                          		if($date1 <= $date2){ echo "llllllllll";*/
                          	?>
							<!-- trip search end  -->
							<table class="table table-bordered">
		        				<thead>
									<th>Train Number</th>
									<th>Trip Date</th>
		        					<th>Departure Time</th>
                            		<th>Arrival Time</th>
                            		<th width="30%">Class Type : Price</th>
									<th></th>	
		        				</thead>
		        				<tbody>
							    	<td><?php echo $row['train_id']?></td>
									<td><?php echo $row['trip_date']?></td>
									<td><?php echo $d_time  ?></td>
									<td><?php echo $a_time  ?></td>
									<td>
										<select class='form-control'>
                                    	<?php foreach ($stmt6 as $row) { $p = $row['price'] + $trip_price; ?>   
                                    		<option value="<?php echo $row['cn']?>"><?php echo $row['name'].' class : '.'price : '.$p?></option >
                                   		<?php  } ?>
										</select>
									</td>
									<td width="20%"><a href='trainMoreDetails.php?id=<?php echo $id ?>&train_id=<?php echo $row['train_id'] ?>' class='btn btn-info btn-sm btn-flat'><i class='fa fa-search'></i> More Detailes</a>
										<!-- <button class='btn btn-primary btn-sm edit btn-flat' data-id=''><i class='fa fa-search'></i> Book now</button> -->
									<?php
									if(isset($_SESSION['user'])){
                                	?>
										<a href='passengerDetailes.php?id=<?php echo $id ?>&trip_id=<?php echo $row['id'] ?>&price=<?php echo $p ?>&from=<?php echo $from?>&to=<?php echo $to?>&d_time=<?php echo $d_time?>&a_time=<?php echo $a_time?>' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-ticket'></i> Book now</a>
										<!-- <button class='btn btn-primary btn-sm edit btn-flat' data-id=''><i class='fa fa-search'></i> Book now</button> -->
									</td>
									<?php
									} /*}
								elseif ($date1 > $date2) {
								 	echo "string";
								 } */?>
								</tbody>
		        			</table>
							<?php
                          }                           
							?>	
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
					?>
	        </div>
		</div>
		<?php
			// }
		} 
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		//}

		$pdo->close();
		}
		// include 'includes/footer.php'; 
		?>
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

