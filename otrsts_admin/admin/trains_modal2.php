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
         Train Addition
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Trains</li>
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
              
            <div class='alert alert-warning alert-dismissible'>
              <h4><i class='icon fa fa-warning'></i> Notice! you have to add train full details, include route price to insure that the train addition operation complete successfuly</h4>
      </div>

            <div class="modal-header">
              <h4 class="modal-title"><b>Add New Train</b></h4>
            </div>
            <br>
            <form class="form-horizontal" method="POST" action="trains_add.php" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Train Number</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="name" name="name" placeholder="Enter train number" required>
                    </div>
                </div>
                
                <br>

              <!--  <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Train Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter train name" required>
                    </div>
                </div>
                
                <br>
              -->
                <div class="form-group">
                    <label for="d1" class="col-sm-3 control-label">Destinations</label>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="d1" name="d1" placeholder="destination 1" required>

                    </div>
                    <div class="col-sm-1">
                    <i class="fa fa-arrows-h"></i>

                    </div>

                    <div class="form-group">

                    <div class="col-sm-3">

                      <input type="text" class="form-control" id="d2" name="d2" placeholder="destination 2" required>
                    </div>

                    </div>
              </div>

            
      
                <div class="modal-header">
                <h4 class="modal-title"><b>TIMINGS : </b></h4>
                </div><br>
                <div class="form-group">
                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>Destination 1 <i class="fa fa-arrow-right "></i>
                    Destination 2</span></strong></h5></center>
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
                <center><h5 class="modal-title"><span style="color: blue";><strong>Destination 1 <i class="fa fa-arrow-left "></i>
                  Destination 2</span></strong></h5></center>
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
                <label for="lastname" class="col-sm-3 control-label">Status</label>
                 <br>
                    <div class="col-sm-9">
                      <input type="radio"  id="status" name="status" value="1" required checked="">Active
                      <input type="radio"  id="status" name="status" value="0" required >Inactive

                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"> Next <i class="fa fa-arrow-circle-right"></i></button>
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
