<?php include 'includes/session.php'; ?>
<?php
  if(!isset($_GET['user'])){
    header('location: users.php');
    exit();
  }
  else{
    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    $stmt->execute(['id'=>$_GET['user']]);
    $user = $stmt->fetch();

    $pdo->close();
  }

?>
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
        <?php echo $user['firstname'].' '.$user['lastname'].'`s Bookings' ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="users.php">Customers</a></li>
        <li class="active">Bookings</li>
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
            <!-- <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" id="add" data-id="<?php echo $user['id']; ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              <a href="users.php" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-arrow-left"></i> Users</a>
            </div> -->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Booking Date</th>
                  <th>Trip No.</th>
                  <th>Ticket ID</th>
                  <th>Passenger Name</th>
                  <th>Booking status</th>


                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                    $payment;
                    $qrcode;

                    try{
                      $stmt = $conn->prepare("SELECT users.id ,passingers.trip_id,passingers.firstname ,passingers.ticket_id as ticket_ID, passingers.created_on,passingers.qrcode FROM passingers INNER JOIN users on users.id=passingers.customer_id and users.id=?");
                      $stmt->execute(array($user['id']));
                      foreach($stmt as $row){
                        $qrcode=$row['qrcode'];
                        if($qrcode!=NULL){
                          $payment="Paid";
                        }
                        else if($qrcode==NULL){
                          $payment="Booked";
                        }
                        
                        echo "
                          <tr>
                            <td>".date('M d, Y', strtotime($row['created_on']))."</td>
                            <td>".$row['trip_id']."</td>
                            <td>".$row['ticket_ID']."</td>
                            <td>".$row['firstname']."</td>
                            <td>".$payment."</td>


                          
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
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/cart_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('#add').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getProducts(id);
  });

  $("#addnew").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

});

function getProducts(id){
  $.ajax({
    type: 'POST',
    url: 'products_all.php',
    dataType: 'json',
    success: function(response){
      $('#product').append(response);
      $('.userid').val(id);
    }
  });
}

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'cart_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.cartid').val(response.cartid);
      $('.userid').val(response.user_id);
      $('.productname').html(response.name);
      $('#edit_quantity').val(response.quantity);
    }
  });
}
</script>
</body>
</html>
