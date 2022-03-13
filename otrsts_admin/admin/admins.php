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
        Admins
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admins</li>
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
          <?php
           if($staff){?>

            <?php }
                              else{?>
<div class="box-header with-border" >
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
<?php } ?>

            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Photo</th>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Role</th>
                  <th>Date Added</th>
                 
                 
                    <th>Tools</th>
                 
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $whichrole;

                      $stmt = $conn->prepare("SELECT * FROM users where role = 1 or role = 2 ");
                      $stmt->execute(array());
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                        if($staff){
                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"></a></span>' : '';
                        }
                        else{
                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                      }
                        $role=$row['role'];
                        if ($role==1){
                          $whichrole="Admin";
                        }
                       if ($role==2){
                          $whichrole="Staff";
                        }
                       
                        echo "
                          <tr>
                            <td>
                              <img src='".$image."' height='30px' width='30px'>
                            </td>
                            <td>".$row['email']."</td>
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                            <td>
                              ".$status."
                              ".$active."
                            </td>
                            <td><strong>".                        $whichrole                            ."</strong></td>

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
    <?php include 'includes/admins_modal.php'; ?>

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
    url: 'admin_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_email').val(response.email);
      $('#edit_password').val(response.password);
      $('#edit_ssn').val(response.ssn);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_contact').val(response.contact_info);
      $('.name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
