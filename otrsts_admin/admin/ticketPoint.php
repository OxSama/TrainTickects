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
        Routes Prices
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Route Price</li>
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
              <table  class="table table-bordered">
                <thead>
                  <th>Route</th>
                  <th>Price</th>
                  
                  
                    <th>Tools</th>
                    
                    
                                  </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                       try{
                         $coloring1='<span style="color: red;">';
                         $coloring2='</span>';
                         $price='';
                        $id = $_GET['id'];
                      $stmt = $conn->prepare("SELECT * FROM price WHERE train_id=? ORDER BY price");
                      $stmt->execute(array($id));
                      

                      foreach($stmt  as $row){
                        $id = $row['id'];
                        $dist1=$row['dist1'];
                        $dist2=$row['dist2'];
                        $name1="";
                        $name2="";

                        $stmt2 = $conn->prepare("SELECT id,name FROM stations");
                      $stmt2->execute(array());
                      foreach($stmt2  as $row2){
                        if($row2['id']==$dist1){
                          $name1=$row2['name'];
                        }
                        else if($row2['id']==$dist2){
                          $name2=$row2['name'];
                        }
                        if($row['price']==0)
                        $price="".$coloring1." ".$row['price']." ".$coloring2."";
                        else
                        $price="".$row['price']."";




                      }



                 if($staff){
                        echo "
                          <tr>
                            
                            <td>".$name1." - ".$name2."</td>

                            <td><strong>".$price."</strong></td>
                            
                            
                          </tr>
                        ";
                 }


                 else{
                  echo "
                    <tr>
                      
                      <td>".$name1." - ".$name2."</td>

                      <td><strong>".$price."</strong></td>
                      
                      <td>
                        <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
          
                      </td>
                    </tr>
                  ";
           }



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
    <?php include 'includes/routePrice_modal.php'; ?>

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
    url: 'routePrice_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
     $('#edit_price').val(response.price);
     // $('#edit_password').val(response.password);
      $('#trainid').val(response.train_id);
      // $('.status').val(response.status);
     // $('#edit_address').val(response.address);
     // $('#edit_contact').val(response.contact_info);
      // $('.name').html(response.name);
    }
  });
}
</script>
</body>
</html>
