<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Trip path</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_add.php" enctype="multipart/form-data">
               
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Train Name</label>

                    <div class="col-sm-9">
                    <select class="form-control"><option >ks88998</option ><option >kjsndf6768</option></select>
                                      </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">From</label>

                    <div class="col-sm-9">
                    <select class="form-control"><option >ks88998</option ><option >kjsndf6768</option></select>
                                      </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">To</label>

                    <div class="col-sm-9">
                    <select class="form-control"><option >ks88998</option ><option >kjsndf6768</option></select>
                                      </div>
                </div>
                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Status</label>
<br>
                    <div class="col-sm-9">
                      <input type="radio"  id="lastname" name="lastname" required checked="">Active
                      <input type="radio"  id="lastname" name="lastname" required >Inactive

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
              <h4 class="modal-title"><b>Edit Trip</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_edit.php">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Train Name</label>

                    <div class="col-sm-9">
                    <select class="form-control"><option >ks88998</option ><option >kjsndf6768</option></select>
                                      </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">From</label>

                    <div class="col-sm-9">
                    <select class="form-control"><option >ks88998</option ><option >kjsndf6768</option></select>
                                      </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">To</label>

                    <div class="col-sm-9">
                    <select class="form-control"><option >ks88998</option ><option >kjsndf6768</option></select>
                                      </div>
                </div>
                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Status</label>
<br>
                    <div class="col-sm-9">
                      <input type="radio"  id="lastname" name="lastname" required checked="">Active
                      <input type="radio"  id="lastname" name="lastname" required >Inactive

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
              <form class="form-horizontal" method="POST" action="users_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE TRIPS PATH</p>
                    <p style="font-size: 18px">Are You Sure You Want To Delete The Path For Train<span style="color: red;font-size: 22px;"class="bold name"></span>?</p>
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
                    <p>ACTIVATE USER</p>
                    <p style="font-size: 18px">Are You Sure You Want To Activate The Path For Train<span style="color: red;font-size: 22px;"class="bold name"></span>?</p>
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


     