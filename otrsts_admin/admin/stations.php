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
        Stations
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
          <?php if($staff){?>
           
            <?php }
                              else{?>
<div class="box-header with-border" >
              <a href="stations_modal2.php?id=<?php echo $_GET['id']?>"  class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
<?php } ?>

            <div class="box-header with-border"> 
               <?php
                    $conn = $pdo->open();
                       try{
                      $id = $_GET['id'];
                      $stmt1 = $conn->prepare("SELECT * FROM stations WHERE train_id=? and root=1 ORDER BY id ASC");
                      $stmt1->execute(array($id)); } 

                        catch(PDOException $e){
                      echo $e->getMessage();
                    }?>
            <input type="text" placeholder="<?php foreach($stmt1  as $row){ echo $row['name'] .' '. '-';} ?>    Path" readonly>
            <!-- <h4><span style="color: blue";><strong>Khartoum </span>- <span style="color: blue";>Atbara</span> Path</strong></h4> -->
            </div>

            <div class="box-body">
              <table  class="table table-bordered">
                <thead>
                  <th>Station name</th>
                  <th>Depature Time</th>
                  <th>Arrival Time</th>
                  <th>Ticket point</th>
                  <th>Status</th>
                  
                  
                    <th>Tools</th>
                    
                               </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                       try{
                      $id = $_GET['id'];
                      $stmt = $conn->prepare("SELECT * FROM stations WHERE train_id=?");
                      $stmt->execute(array($id));
                      //$rows = $stmt->fetch();
                      foreach($stmt  as $row){
                        $id = $row['id'];
                        if ($row['status']) {
                         $status = '<span class="label label-success"> Active</span>' ;
                        }
                        else {
                         $status = '<span class="label label-danger">not active</span>';

                        }
                          if ($row['ticket_point']) {
                         $ticket_point = ' Yes ';
                        }
                        else {
                         $ticket_point = 'No';

                        }
                        $going_dep_time=  date ('h:i A',strtotime($row['going_dep_time']));
                        $going_arr_time=  date ('h:i A',strtotime($row['going_arr_time']));


                       // $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not active</span>';
                        // $status = ($row['status']) ? '<span class="label label-danger">inactive</span>' : '<span class="label label-danger">not verified</span>';
                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';

                        //$active = (!$row['status']) ? '<span class="pull-right"><a href="station_activate.php?id='.$id.'" class="status" data-toggle="modal" 
                       // data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        echo "
                          <tr>
                            <td>".$row['name']."</td>
                            <td>".$going_dep_time."</td>
                            <td>".$going_arr_time."</td>
                            <td>".$ticket_point."</td>
                            <td> " .$status
                                   .$active  . "</td>
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
                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                        // $status = ($row['status']) ? '<span class="label label-danger">inactive</span>' : '<span class="label label-danger">not verified</span>';

                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        echo "
                          <tr>
                            
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
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
                    } */

                    $pdo->close();
                  ?>
                </tbody>
              </table>

              
              <div class="box-header with-border">
            </div>
<div class="box-header with-border" >

  <?php
                    $conn = $pdo->open();
                       try{
                      $id = $_GET['id'];
                      $stmt1 = $conn->prepare("SELECT * FROM stations WHERE train_id=? and root=1 ORDER BY id DESC");
                      $stmt1->execute(array($id)); } 

                        catch(PDOException $e){
                      echo $e->getMessage();
                    }?>
         <input type="text" placeholder="<?php foreach($stmt1  as $row){ echo $row['name'] .' '. '-';} ?>    Path" readonly>

<!-- <h4><span style="color: blue";><strong>Atbara </span>- <span style="color: blue";>Khartoum</span> Path</strong></h4> -->
            </div>
            <div class="box-header with-border">
            </div>

              <table  class="table table-bordered">
                <thead>
                  <th>Station name</th>
                  <th>Depature Time</th>
                  <th>Arrival Time </th>
                  <th>Ticket Point</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                       try{
                        $id = $_GET['id'];
                      $stmt = $conn->prepare("SELECT * FROM stations WHERE train_id=?");
                      $stmt->execute(array($id));
                      //$rows = $stmt->fetch();
                      foreach($stmt  as $row){
                        $id = $row['id'];
                        if ($row['status']) {
                         $status = '<span class="label label-success"> Active</span>' ;
                        }
                        else {
                         $status = '<span class="label label-danger">not active</span>';

                        }
                         if ($row['ticket_point']) {
                         $ticket_point = ' Yes ';
                        }
                        else {
                         $ticket_point = 'No';

                        }
                        $return_dep_time=  date ('h:i A',strtotime($row['return_dep_time']));
                        $return_arr_time=  date ('h:i A',strtotime($row['return_arr_time']));
                        // if ($row['root']) {
                        //   $return_dep_time=  '-';
                        //   $return_arr_time=  '-';
                        //  }

                      

                       // $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not active</span>';
                        // $status = ($row['status']) ? '<span class="label label-danger">inactive</span>' : '<span class="label label-danger">not verified</span>';
                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';

                        //$active = (!$row['status']) ? '<span class="pull-right"><a href="station_activate.php?id='.$id.'" class="status" data-toggle="modal" 
                       // data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        echo "
                          <tr>
                            
                            <td>".$row['name']."</td>
                            <td>".$return_dep_time."</td>
                            <td>".$return_arr_time."</td>
                            <td>".$ticket_point."</td>
                            <td> " .$status
                                   .$active  . "</td>
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
                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                        // $status = ($row['status']) ? '<span class="label label-danger">inactive</span>' : '<span class="label label-danger">not verified</span>';

                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        echo "
                          <tr>
                            
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
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
                    } */

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
    <?php include 'includes/stations_modal.php'; ?>

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
    url: 'station_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
     // $('#edit_email').val(response.email);
     // $('#edit_password').val(response.password);
      $('.form-control').val(response.name);
      $('.status').val(response.status);
     $('#edit_going_depart').val(response.going_dep_time);
     $('#edit_going_arriv').val(response.going_arr_time);
     $('#edit_return_depart').val(response.return_dep_time);

     $('#edit_return_arriv').val(response.return_arr_time);


     // $('#edit_contact').val(response.contact_info);
      $('.name').html(response.name);
    }
  });
}
</script>
</body>
</html>
