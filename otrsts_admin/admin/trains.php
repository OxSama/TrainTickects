<?php include 'includes/session.php'; 
$staff=false;
if(isset($_SESSION['staff']))
     {
       $staff=true;
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
        Trains
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
      
<div class="box-header with-border" >
              <a href="trains_modal2.php"  class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Photo</th>
                  <th>Number</th>
                  <th>Basic Route</th>
                  <th>Routes</th>
                  <th>Stations</th>
                  <th>Trailers</th>
                  <th>Classes</th>
                  <th>Trips</th>
                  <th>Status</th>
                  <th>Date Added</th>
                  
                  
                    <th>Tools</th>
                                   </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                     try{
                     /* $stmt = $conn->prepare("SELECT trains.*,  classes.id as class ,classes.count(*) as cn, train_trailers.id as tt, train_trailers.count(*) , stations.id as s ,stations.count(*)
                                              FROM trains 
                                              inner join classes on (classes.id = train_trailers.class_id )
                                                and (train_trailers.id)"); show this after find internet*/

                      $stmt = $conn->prepare("SELECT * FROM trains ");
                      $stmt->execute(array());
                      $tripsR;
                      $stationsR;
                      $trailersR;
                      $routesR;
                      $classesR;
                      $st1;
                      $str2;
                      foreach($stmt as $row){
                        $train_id=$row['id'];
                        $stmt2 = $conn->prepare("SELECT COUNT(id) as NumberOfTripRows FROM trips WHERE train_id = ? ");
                      $stmt2->execute(array($train_id));
                      foreach($stmt2 as $row2){ 

                      $tripsR=$row2['NumberOfTripRows'];
                      }
                      $stmt3 = $conn->prepare("SELECT COUNT(id) as NumberOfStationsRows FROM stations WHERE train_id = ? ");
                      $stmt3->execute(array($train_id));
                      foreach($stmt3 as $row3){ 

                      $stationsR=$row3['NumberOfStationsRows'];
                      }
                      $stmt4 = $conn->prepare("SELECT COUNT(id) as NumberOfTrailersRows FROM train_trailers WHERE train_id = ? ");
                      $stmt4->execute(array($train_id));
                      foreach($stmt4 as $row4){ 

                      $trailersR=$row4['NumberOfTrailersRows'];
                      }
                      $stmt5 = $conn->prepare("SELECT COUNT(id) as NumberOfRoutesRows FROM price WHERE train_id = ? ");
                      $stmt5->execute(array($train_id));
                      foreach($stmt5 as $row5){ 

                        $routesR=$row5['NumberOfRoutesRows'];
                      }
                      $stmt6 = $conn->prepare("SELECT COUNT(id) as NumberOfClassesRows FROM classes WHERE train_id = ? ");
                      $stmt6->execute(array($train_id));
                      foreach($stmt6 as $row6){ 

                        $classesR=$row6['NumberOfClassesRows'];
                      }
                      $stmt7 = $conn->prepare("SELECT name FROM stations WHERE train_id = ? and root=1");
                      $stmt7->execute(array($train_id));
                      foreach($stmt7 as $row7){ 
                        $st1=$row7['name'];
                        break;
                      }
                      foreach($stmt7 as $row7){ 
                        $st2=$row7['name'];
                      }


                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/train2.jpg';
                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not active</span>';
                        // $status = ($row['status']) ? '<span class="label label-danger">inactive</span>' : '<span class="label label-danger">not verified</span>';
                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        echo "
                          <tr>
                            <td>
                              <img src='".$image."' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>".$row['id']."</td>
                            <td>$st1 <i class='fa fa-arrows-h'></i> $st2</td>
                            <td><a href='ticketPoint.php?id=".$row['id']."' >$routesR</a></td>

                            <td><a href='stations.php?id=".$row['id']."' >$stationsR</a></td>

                            <td><a href='trainDetails.php?id=".$row['id']."' >$trailersR</a></td>
                            <td><a href='seats.php?id=".$row['id']."' >$classesR</a></td>
                            <td><a href='tripsDetails.php?id=".$row['id']."' >$tripsR</a></td>

                            
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
    <?php include 'includes/trains_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>

// $(window).on('load',function(){

// $('#myModal2').modal('show');
// 	});



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
    url: 'trains_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_trainid').val(response.id);
      // $('edit_d1').val(response.d1);
      // $('edit_d2').val(response.d2);
      // $('edit_price').val(response.price);
      // $('edit_time11').val(response.DepartureTime1);
      // $('edit_time12').val(response.ArrivalTime1);
      // $('edit_time21').val(response.DepartureTime2);
      // $('edit_time22').val(response.ArrivalTime2);
      $('.trainid').html(response.id);
    }
  });
}




</script>
</body>
</html>
