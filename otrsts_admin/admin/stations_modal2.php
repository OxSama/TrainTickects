

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
         Station Addition
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Station</li>
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

<?php 
  $train_id = $_GET['id'];
 $stmt = $conn->prepare("SELECT * FROM stations ");
                      $stmt->execute(array());
                     ?>

                     
                      <?php
                      $conn = $pdo->open();
                       try{
                      $id = $_GET['id'];
                      $stmt1 = $conn->prepare("SELECT * FROM stations WHERE train_id=? and root=1 ORDER BY id ASC");
                      $stmt1->execute(array($id)); } 

                        catch(PDOException $e){
                      echo $e->getMessage();
                    }?>

                     <?php
                    $conn = $pdo->open();
                       try{
                      $id = $_GET['id'];
                      $stmt2 = $conn->prepare("SELECT * FROM stations WHERE train_id=? and root=1 ORDER BY id DESC");
                      $stmt2->execute(array($id)); } 

                        catch(PDOException $e){
                      echo $e->getMessage();
                    }?>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
            <div class='alert alert-warning alert-dismissible'>
              <h4><i class='icon fa fa-warning'></i> Notice! you have to add station full details, include routes prices to insure that the station addition operation complete successfuly</h4>
      </div>

            <div class="modal-header">
              <h4 class="modal-title"><b>Add New Station</b></h4>
            </div>
            <br>
            <form class="form-horizontal" method="POST" action="station_add.php" enctype="multipart/form-data">
              <input type="hidden" name="trainid" value="<?php echo $train_id ?>">

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Station Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter station name" required>
                    </div>
                </div>

                <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Status</label>
<br>
                    <div class="col-sm-9">
                      
                      <input type="radio"  id="active" name="status" required checked="" value="1">Active
                      <input type="radio"   id="inactive" name="status" required value="0">Inactive
                     
                </div>
             </div>

                <div class="modal-header">
                <h4 class="modal-title"><b>TIMINGS : </b></h4>
                </div><br>
                <div class="form-group">
                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>
                  <?php foreach($stmt1  as $row){ echo $row['name'] .' '. '-';} ?> </span> Path :</strong></h5></center>
                </div><br>

                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="price" name="DepartureTime1" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="price" name="ArrivalTime1" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>
                <br>

                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>
                 <?php foreach($stmt2  as $row){ echo $row['name'] .' '. '-';} ?> </span> Path :</strong></h5></center>
                </div><br>

                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="price" name="DepartureTime2" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="price" name="ArrivalTime2" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>

                <div class="modal-header"></div>
                <br>

                <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Ticket Point?</label>
                 <br>
                    <div class="col-sm-9">
                      <input type="radio"  id="status" name="TicketPoint" required  value="1">Yes
                      <input type="radio"  id="status" name="TicketPoint" required value="0">No
                </div>
             </div>

                
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-flat" name="add">Next <i class="fa fa-arrow-circle-right"></i></button>
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
