<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Station Creation
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Stations</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              


            <div class="modal-header">
              <h4 class="modal-title"><b>Add staion Routes Prices</b></h4>
            </div>
            <br>
            <form class="form-horizontal" method="POST" action="StationPrice.php" enctype="multipart/form-data">

           <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">

<?php 
      $id = $_GET['id'];
//echo $id;
      $station = $_GET['station'];
      $station_id ='';
      $count = '';
      ?>

              
      <?php
      try{

             $stmt1 = $conn->prepare("SELECT * from stations where train_id = :train_id");
             $stmt1->execute(['train_id'=>$id]);


           $stmt2 = $conn->prepare("SELECT * from stations where train_id = :train_id and ticket_point = 1");
             $stmt2->execute(['train_id'=>$id]);
      
   $stmt3 = $conn->prepare("SELECT * from stations where name = :name and train_id = :train_id order by id desc limit 1");
             $stmt3->execute(['name'=>$station,'train_id'=>$id]);
$stationArray=array();

                 foreach ($stmt3 as $row) {
                   $station_id = $row['id'];
                  // echo  $station_id ;
                   if ($row['ticket_point'] == 1) {
                     $count = $stmt1->rowCount() - 1;
                    foreach ($stmt1 as $row1) {
                    // echo $row1['name'];
                    array_push($stationArray,$row1['name']);
                    // print_r(json_encode(array_values($stationArray)));
                    ?>
                      <input type="hidden" name="distnation[]" value="<?php echo $row1['id']; ?>"> 
                    <?php  }
                   }

                   if ($row['ticket_point'] == 0) {
                      $count = $stmt2->rowCount();

                     foreach ($stmt2 as $row2) { echo $row2['name'];?>
                      <input type="hidden" name="distnation[]" value="<?php echo $row2['id']?>"> 
                    <?php }
                   } }
                 ?>

              <input type="hidden" name="station_id" value="<?php echo $station_id; ?>"> 

                 <?php 
                 // echo $station_id;


      for ($i=0; $i < $count ; $i++) { ?>

           <div class="form-group" >
                    <label for="name" class="col-sm-1 control-label"></label>

                    <div class="col-sm-10">
                  

                      <input type="text" class="form-control" id="name" name="price[]" 
                      placeholder="Enter price for route between <?php  echo $stationArray[$i]; ?> station and <?php echo $_GET['station'];?> station" required>

                      <!--<input type="hidden" name="distnation[]" value="<?php //echo  ?>"> -->
<?php
                       foreach ($stmt3 as $row) {
                  $station_id = $row['id'];
                   if ($row['ticket_point'] == 1) {
                    
                     foreach ($stmt1 as $row1) {
                   //  echo $row1['id'];?>
                       <input type="hidden" name="distnation[]" value="<?php echo $row1['id']; ?>">
                    <?php  }
                   }

                   if ($row['ticket_point'] == 0) {
                     

                       foreach ($stmt2 as $row2) { //echo $row2['id'];?>
                       <input type="hidden" name="distnation[]" value="<?php echo $row2['id']?>">
                    <?php }
                   } }
                 ?>

                    </div>
                </div>

               
      


    <?php   
      } }
  catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }

?>
                 


              
 
              

                
               
            </div>
            <div class="modal-footer">
            <center>

              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save </button>
    </center>
              </form>





            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->


</body>
</html>
