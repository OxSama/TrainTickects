<!-- Add -->

<?php 
$id = $_GET['id'];
?> 
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Class</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="seat_add.php" enctype="multipart/form-data">
             <input type="hidden" class="form-control" name="trainid" value="<?php echo $id ?>">
                <div class="form-group">
                    <label for="className" class="col-sm-3 control-label">Class Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="className" name="className" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Price</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="classDescription" class="col-sm-3 control-label">Class Description</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="classDescription" name="classDescription"></textarea>
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
              <h4 class="modal-title"><b>Edit Class</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="sets_edit.php">
                <input type="hidden" class="userid" name="id">
                <input type="hidden" class="form-control" name="trainid" value="<?php echo $id ?>">

                <div class="form-group">
                    <label for="className" class="col-sm-3 control-label">Class Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Price</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_price" name="price" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="classDescription" class="col-sm-3 control-label">Class Description</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="edit_description" name="description"></textarea>
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
              <form class="form-horizontal" method="POST" action="seats_delete.php">
                <input type="hidden" class="userid" name="id" value="<?php echo $_GET['id']?>">
                <div class="text-center">
                    <p>DELETE CLASS</p>
                    <p style="font-size: 18px">Are You Sure You Want To Delete <span style="color: red;font-size: 22px;"class="bold name"></span> Class?</p>

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
              <form class="form-horizontal" method="POST" action="users_activate.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>ACTIVATE CLASS</p>
                    <h2 class="bold fullname"></h2>
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


     