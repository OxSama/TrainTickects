<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Add New Station</b></h3>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="station_add.php" enctype="multipart/form-data">
            
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Station Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>

                <div class="modal-header">
                <h4 class="modal-title"><b>Timings</b></h4>
                </div><br>
                <div class="form-group">
                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>Khartoum - Atbara</span> Path :</strong></h5></center>
                </div><br>

                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="price" name="price" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="price" name="price" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>
                <br>

                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>Atbara - Khartoum</span> Path :</strong></h5></center>
                </div><br>

                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="price" name="price" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="price" name="price" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>

                <div class="modal-header"></div>
                <br>

                <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Ticket Point?</label>
                 <br>
                    <div class="col-sm-9">
                      <input type="radio"  id="status" name="status" required  value="1">Yes
                      <input type="radio"  id="status" name="status" required value="0">No
                </div>
             </div>


                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Next</button>
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
              <h4 class="modal-title"><b>Edit Station</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="station_edit.php">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Station Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Going Price</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="price" name="price"  required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Return Price</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="price" name="price"  required>
                    </div>
                </div>

                <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Status</label>
<br>
                    <div class="col-sm-9">
                      
                      <input type="radio"  id="active" name="status" required checked="" value="1">Active
                      <input type="radio"   id="inactive" name="status" required value="0">Inactive
                     
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
              <form class="form-horizontal" method="POST" action="station_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE STATION</p>
                    <p style="font-size: 18px">Are You Sure You Want To Delete <span style="color: red;font-size: 22px;"class="bold name"></span> Station?</p>
                   
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
              <form class="form-horizontal" method="POST" action="station_activate.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>ACTIVATE STATION</p>
                    <p style="font-size: 18px">Are You Sure You Want To Activate <span style="color:green;font-size: 22px;"class="bold name"></span> Station?</p>
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


     