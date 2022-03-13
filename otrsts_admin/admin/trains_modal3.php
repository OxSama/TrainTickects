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
         Train Creation
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
              


            <div class="modal-header">
              <h4 class="modal-title"><b>Add Train Main Route Price</b></h4>
            </div>
            <br>
            <form class="form-horizontal" method="POST" action="RootPrice.php" enctype="multipart/form-data">
          
<?php $id = $_GET['id'];?>
                 

              <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Route Price</label>

                    <div class="col-sm-9">
                      <input type="hidden" name="id" value="<?php echo $id ?>">
                      <input type="number" class="form-control" id="name" name="price" placeholder="Enter route price" required>
                    </div>
                </div>
      
              

              

                
               
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
