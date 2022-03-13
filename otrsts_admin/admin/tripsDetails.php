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
        Trips details
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="trips.php">Trips paths</a></li>
        <li class="active">Trips details</li>
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
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Trip Number</th>
                  <th>Trip Path</th>
                  <th>Depature Date</th>
                  <th>Available Seats</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                     try{
                      $train_id = $_GET['id'];
                      
                      $stmt = $conn->prepare("SELECT * FROM trips WHERE train_id = :train ");
                      $stmt->execute(['train'=>$train_id ]);
                      foreach($stmt as $row){

                         $stmt1 = $conn->prepare("SELECT train_trailers.*,  classes.id as class ,classes.name as cn
                                              FROM train_trailers 
                                              inner join classes on classes.id = train_trailers.class_id 
                                                and train_trailers.train_id = :train and train_trailers.status = 1");
                      $stmt1->execute(['train'=>$row['train_id']]);
                        //$image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not active</span>';
                        // $status = ($row['status']) ? '<span class="label label-danger">inactive</span>' : '<span class="label label-danger">not verified</span>';
                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        //echo "?>
                          <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['trip_path'] ?></td>

                            <td><?php echo $row['trip_date'] ?></td>
                            <td>
                          <select class='form-control'>
                              <?php foreach($stmt1 as $row1){ ?>
                                <option><?php echo 'trailer no:'.$row1['trailer_num'].'  /  '.$row1['cn'] . ' '.'Class'.' : '.$row1['seats_no'] .' seat';}?>
                                </option >
                                                                               
                           </select>
                            </td>
                            <td>
                             <?php echo $status. $active ?>
                            </td>
                            <td>

                            <a href='passengers.php?tripNo=<?php echo $row['id'] ?>&trainId=<?php echo $train_id ?> ' class='btn btn-info btn-sm btn-flat'><i class='fa fa-search'></i> Passengers</a>
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='<?php echo $row['id'] ?>'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='<?php echo $row['id'] ?>'>
                                <i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                      <?php
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
           } ?> <?php
                   /* try{
                      $stmt = $conn->prepare("SELECT * FROM users WHERE type=:type");
                      $stmt->execute(['type'=>0]);
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                        // $status = ($row['status']) ? '<span class="label label-danger">inactive</span>' : '<span class="label label-danger">not verified</span>';
                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        echo "
                          <tr>
                            <td>
                              <img src='".$image."' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>".$row['email']."</td>
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                            <td><select><option >Business Class</option ><option >Economy Class</option></select></td>
                            <td>
                              ".$status."
                              ".$active."
                            </td>
                            <td>".date('M d, Y', strtotime($row['created_on']))."</td>
                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }
                       */
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
    <?php include 'includes/tripsDetails_modal.php'; ?>

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
    url: 'trip_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_date').val(response.trip_date);
      $('#edit_path').val(response.trip_path);
      $('#edit_status').val(response.status);
      // $('#edit_lastname').val(response.lastname);
      // $('#edit_address').val(response.address);
      // $('#edit_contact').val(response.contact_info);
      $('.tripid').html(response.id);
      $('.tripstatus').val(response.status);



      

    }
  });
}
</script>
</body>
</html>
