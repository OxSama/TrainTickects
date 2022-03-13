<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Admin</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="admins_add.php" enctype="multipart/form-data">
                <div class="form-group">

                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Role</label>
<br>
                    <div class="col-sm-9">
                      <input type="radio"  id="admin" name="role" required checked=""  value="1">Admin
                      <input type="radio"  id="staff" name="role" required  value="2">Staff
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>
                 <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Gender</label>
                <br>
                    <div class="col-sm-9">
                      <input type="radio"  id="female" name="gender" required checked=""  value="1">Female
                      <input type="radio"  id="male" name="gender" required  value="0">Male
                    </div>
                  </div>
                    
                    <br>
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
<!--                 
                
                 <div class="form-group">
                    <label for="ssn" class="col-sm-3 control-label">SSN</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="ssn" name="ssn" required>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-8">
                      <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="contact" name="contact">
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo">
                    </div>
                </div>


                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Status</label>
<br>
                    <div class="col-sm-9">
                      <input type="radio"  id="status" name="status" required checked="" value="1">Active
                      <input type="radio"  id="status" name="status" required value="0">Inactive
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
              <h4 class="modal-title"><b>Edit Admin</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="admin_edit.php">
                <input type="hidden" class="userid" name="id">
                
                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Role</label>
<br>
                <div class="col-sm-9">
                      <input type="radio"  id="admin" name="role" required checked=""  value="1">Admin
                      <input type="radio"  id="staff" name="role" required  value="2">Staff
                   <br>
                     <label for="lastname" class="col-sm-3 control-label">Status</label>
                     <br>
                      <input type="radio"  id="active" name="status" required checked=""  value="1">Active
                      <input type="radio"  id="inactive" name="status" required  value="0">Inactive
                    
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            </div>
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
              <form class="form-horizontal" method="POST" action="admins_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE ADMIN</p>
                    <p style="font-size: 18px">Are You Sure You Wont To Delete <span style="color: red;font-size: 22px;"class="blod name"></span></p>
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
              <form class="form-horizontal" method="POST" action="admin_activate.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>ACTIVATE USER</p>
                    <p style="font-size: 18px">Are You Sure You Wont To Active <span style="color: green;font-size: 22px;"class="blod name"></span></p>
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


     