
<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Train</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="trains_add.php" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Train Number</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="name" name="name" placeholder="Enter train number" required>
                    </div>
                </div>
                
                <br>

              <!--  <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Train Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter train name" required>
                    </div>
                </div>
                
                <br>
              -->
                <div class="form-group">
                    <label for="d1" class="col-sm-3 control-label">Destinations</label>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="d1" name="d1" placeholder="destination 1" required>

                    </div>
                    <div class="col-sm-1">
                    <i class="fa fa-arrows-h"></i>

                    </div>

                    <div class="form-group">

                    <div class="col-sm-3">

                      <input type="text" class="form-control" id="d2" name="d2" placeholder="destination 2" required>
                    </div>

                    </div>
              </div>

              <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Route Price</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="name" name="price" placeholder="Enter route price" required>
                    </div>
                </div>
      
                <div class="modal-header">
                <h4 class="modal-title"><b>TIMINGS : </b></h4>
                </div><br>
                <div class="form-group">
                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>Destination 1 <i class="fa fa-arrow-right "></i>
                    Destination 2</span></strong></h5></center>
                </div><br>

                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="price" name="DepartureTime1" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="price" name="ArrivalTime1" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>
                <br>

                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>Destination 1 <i class="fa fa-arrow-left "></i>
                  Destination 2</span></strong></h5></center>
                </div><br>

                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="price" name="DepartureTime2" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="price" name="ArrivalTime2" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>

                <div class="modal-header"></div>
                <br>

                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Status</label>
                 <br>
                    <div class="col-sm-9">
                      <input type="radio"  id="status" name="status" value="1" required checked="">Active
                      <input type="radio"  id="status" name="status" value="0" required >Inactive

                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo">
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
              <h4 class="modal-title"><b>Edit Train</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="trains_edit.php">
                <input type="hidden" class="userid" name="id">
               
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Train Number</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_trainid" name="name"  required>
                    </div>
                </div>
                
                <br>
                <div class="form-group">
                    <label for="d1" class="col-sm-3 control-label">Destinations</label>

                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="edit_d1" name="d1" required>

                    </div>
                    <div class="col-sm-1">
                    <i class="fa fa-arrows-h"></i>

                    </div>

                    <div class="form-group">

                    <div class="col-sm-3">

                      <input type="text" class="form-control" id="edit_d2" name="d2" required>
                    </div>

                    </div>
              </div>

              <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Route Price</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_price" name="price"  required>
                    </div>
                </div>
      
                <div class="modal-header">
                <h4 class="modal-title"><b>TIMINGS : </b></h4>
                </div><br>
                <div class="form-group">
                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>Khartoum - Atbara</span></strong></h5></center>
                </div><br>

                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="edit_time11" name="DepartureTime1" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="edit_time12" name="ArrivalTime1" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>
                <br>

                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>Atbara - Khartoum</span></strong></h5></center>
                </div><br>

                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="edit_time21" name="DepartureTime2" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="edit_time22" name="ArrivalTime2" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>

                <div class="modal-header"></div>
                <br>

                <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label">Status</label>
<br>
                    <div class="col-sm-9">
                      <input type="radio"  id="status" name="status" value="1" required >Active
                      <input type="radio"  id="status" name="status" value="0" required >Inactive

                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo">
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
              <form class="form-horizontal" method="POST" action="trains_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE TRAIN</p>
                    <p style="font-size: 18px">Are You Sure You Want To Delete Train Number <span style="color: red;font-size: 22px;"class="bold trainid"></span> ?</p>
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
              <form class="form-horizontal" method="POST" action="trains_photo.php" enctype="multipart/form-data">
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
              <form class="form-horizontal" method="POST" action="trains_activate.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>ACTIVATE Train</p>
                    <p style="font-size: 18px">Are You Sure You Want To Activate <span style="color: green;font-size: 22px;"class="bold trainid"></span> Train?</p>
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


     