 <?php 
 $now = date('Y-m-d');
  $train_id = $_GET['id'];
                     ?>
                     <?php
                      $conn = $pdo->open();
                       try{
                      $id = $_GET['id'];
                      $stmt1 = $conn->prepare("SELECT * FROM stations WHERE train_id=? and root=1 ORDER BY id ASC");
                      $stmt1->execute(array($id)); 
                       } 
                        catch(PDOException $e){
                      echo $e->getMessage();
                    }?>

                     <?php
                    $conn = $pdo->open();
                       try{
                      $id = $_GET['id'];
                      $stmt2 = $conn->prepare("SELECT * FROM stations WHERE train_id=? and root=1 ORDER BY id DESC");
                      $stmt2->execute(array($id)); 
                       } 
                        catch(PDOException $e){
                      echo $e->getMessage();
                    }?>
                    
                    <!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Trip</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="trip_add.php" enctype="multipart/form-data">
                 <input type="hidden" name="trainid" value="<?php echo $train_id ?>">
         
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Trip Path</label>
                         
                
                 <?php
                  foreach($stmt1  as $row){ 
                    $d1=' '.$row['name'].' '. '-';} ?>
                    <?php
                  foreach($stmt2  as $row){ 
                    $d2=' '.$row['name'] .' '. '-' ;} ?>
                
                    <div class="col-sm-9">

                    <select class="form-control" name="path"> 
                         <option value='<?php echo $d2.$d1 ?>'>
                                <?php echo $d2.$d1 ?> 
                          </option >
                           <option value='<?php echo $d1.$d2 ?>'>
                                  <?php echo $d1.$d2 ?> 
                          </option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Depature Date</label>

                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="contact" name="DepatureDate" min="<?php echo $now;?>">
                    </div>
                </div>
                
              
                                                
                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Status</label>
<br>
                    <div class="col-sm-9">
                      <input type="radio"  id="lastname" name="status" value="1" required checked="">Active
                      <input type="radio"  id="lastname" name="status" value="0" required >Inactive

                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
 <?php 
  $train_id = $_GET['id'];
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
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Trip details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="trip_edit.php">
                <input type="hidden" class="userid" name="id">
                 <input type="hidden" name="trainid" value="<?php echo $train_id ?>">
               
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Trip path</label>

                    <div class="col-sm-9">

                    <select class="form-control" name="path">
                       <?php
                  foreach($stmt1  as $row){ 
                    $d1=' '.$row['name'].' '. '-';} ?>
                    <?php
                  foreach($stmt2  as $row){ 
                    $d2=' '.$row['name'] .' ' ;} ?>
                
                    <div class="col-sm-9">

                    
                         <option value='<?php echo $d2.$d1 ?>'>
                                <?php echo $d2.$d1 ?> 
                          </option >
                           <option value='<?php echo $d1.$d2 ?>'>
                                  <?php echo $d1.$d2 ?> 
                          </option>
                  
                    </select>
                  </div>
                </div>
           
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Depature Date</label>

                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="edit_date" name="DepatureDate">
                    </div>
                </div>
                
              
                                
                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Status</label>
<br>
                    <div class="col-sm-9">
                      <?php if(true){?>
<input type="radio"  id="edit_status1" name="status" value="1" required >Active
<input type="radio"  id="edit_status2" name="status" value="0" required >Inactive

                     <?php }
                      
                      ?>
  
                      
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="trip_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE TRIP</p>
                    <p style="font-size: 18px">Are You Sure You Want To Delete Trip Number <span style="color: red;font-size: 22px;" class="bold tripid"></span> ?</p>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>




<!-- Activate -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Activating...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="trip_activate.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>ACTIVATE USER</p>
                    <p style="font-size: 18px">Are You Sure You Want To Activate Trip Number <span style="color: red;font-size: 22px;"class="bold tripid"></span> ?</p>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i> Activate</button>
              </form>
            </div>
        </div>
    </div>
</div> 


     