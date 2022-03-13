

<!-- <a data-toggle="modal" href="#myModal" class="btn btn-primary">Launch modal</a> -->
<!-- 
<div class="modal fade" id="addnew">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Modal title</h4>    
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div><div class="container"></div>
            <div class="modal-body">
              ...
              <a data-toggle="modal" href="#myModal2" class="btn btn-primary">Open modal2</a>
            </div>
            <div class="modal-footer">
              <a href="#" data-dismiss="modal" class="btn">Close</a>
            </div>
          </div>
        </div>
</div> -->




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

              <!-- <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Route Price</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="name" name="price" placeholder="Enter route price" required>
                    </div>
                </div> -->
      
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
              <!-- <a data-toggle="modal" href="#myModal2" class="btn btn-primary btn-flat">Continue</a> -->

              <button type="submit" class="btn btn-primary btn-flat" name="add" > Continue</button>
              </form>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="myModal2" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add route price</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div><div class="container"></div>
            <div class="modal-body">
            <form class="form-horizontal" method="POST" action="station_add.php" enctype="multipart/form-data">
              <input type="hidden" name="trainid" value="<?php echo $train_id ?>">

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Route price</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter station name" required>
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


     