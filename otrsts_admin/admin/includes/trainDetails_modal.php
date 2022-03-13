 <?php 
 $train_id = $_GET['id'];
 $stmt = $conn->prepare("SELECT * FROM classes WHERE train_id = ?");
                      $stmt->execute(array($train_id));

                       $stmt1 = $conn->prepare("SELECT * FROM classes WHERE train_id = ?");
                      $stmt1->execute(array($train_id)); 
                    
?>
                        <!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Trailer</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="train_d_add.php" enctype="multipart/form-data">
              <input type="hidden" name="trainid" value="<?php echo $train_id ?>">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Trailer Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="num" name="num" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Class Type</label>

                    <div class="col-sm-9">

                   <select class="form-control" name="classname"> <?php foreach($stmt as $row){ ?>
                                                                          <option value='<?php echo $row['id']; ?>' > <?php
                                                                            echo $row['name'];
                                                                                 }?> 
                                                                                 </option >
                    </select>
                  </div>
                </div>
                
                
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Number of Seats</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="seatsno" name="seatsno" required>
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
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Trailer</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="train_d_edit.php">
                 <input type="hidden" name="trainid" value="<?php echo $train_id ?>">
                 <input type="hidden" class="userid" name="id">
               
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Trailer Number</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_num" name="num" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Class Type</label>

                   <div class="col-sm-9">
                     <select class="form-control" name="classname"> <?php foreach($stmt1 as $row){ ?>
                                                                          <option value='<?php echo $row['id']; ?>'> <?php
                                                                            echo $row['name'];
                                                                                 }?> 
                                                                                 </option >
                    </select>
                  </div>
                </div>
                
                
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Number of Seats</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_seatsno" name="seatsno" required>
                    </div>
                
                </div>
                
                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Status</label>
<br>
                    <div class="col-sm-9">
                      <input type="radio"  id="status" name="status" value="1" required checked="">Active
                      <input type="radio"  id="status" name="status" value="0" required >Inactive

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
              <form class="form-horizontal" method="POST" action="train_d_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                   <p>DELETE TRAIN TRAILER</p>
                    <p style="font-size: 18px">Are You Sure You Want To Delete Trailer Numbe <span style="color: red;font-size: 22px;"class="blod name"></span></p>
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

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
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
              <form class="form-horizontal" method="POST" action="train_d_activate.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>ACTIVATE USER</p>
                    <p style="font-size: 18px">Are You Sure You Want To Activate Trailer Number <span style="color: green;font-size: 22px;"class="bold name"></span> ?</p>
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


     