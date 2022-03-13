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
        Passengers
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="trips.php">Trips</a></li>
        <li class="active">Passengers</li>

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
           
          <div class="box-header with-border" >
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-envelope"></i> Send message</a>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <th>Ticket ID</th>

                  <th>Full Name</th>
                  <th>Class Type</th>
                  <th>Capin No.</th>
                  <th>Seat No. </th>
                  <th>Ticket Price</th>

                  <th>Booking Status</th>
                  <th>Payment Method</th>
                  <th>Customer Name</th>
                  <th>Booking Date</th>
                 
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $trip_no = $_GET['tripNo'];
                      $payment_method="";
                      $booking_status="";

                      $stmt = $conn->prepare("SELECT * FROM passingers WHERE trip_id=?");
                      $stmt->execute(array($trip_no));
                      foreach($stmt as $row){

                        // if($row['payment_method']==0){
                        //   $payment_method="Online";
                        // }
                        // else{
                        //   $payment_method="Offline";
                        // }

                        // if($row['booking_status']==0){
                        //   $booking_status="booked";
                        // }
                        // else if($row['booking_status']==1){
                        //   $booking_status="payed";
                        // }
                        // else {
                        //   $booking_status="refunded";
                        // }

                        // $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                        // $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        echo "
                          <tr>
                          <td>".$row['ticket_id']."</td>
                            <td>".$row['firstname']."</td>
                            <td>Second Class</td>
                            <td>550</td>
                            <td>26</td>
                            <td>3500 SDG</td>
                            <td>Paid</td>
                            <td>Online</td>
                            <td>razan hasan</td>
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
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/passenger_modal.php'; ?>

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

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.status', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'users_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_email').val(response.email);
      $('#edit_password').val(response.password);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_contact').val(response.contact_info);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
