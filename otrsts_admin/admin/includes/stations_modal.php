<?php 
  $train_id = $_GET['id'];
 $stmt = $conn->prepare("SELECT * FROM stations ");
                      $stmt->execute(array());
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
              <input type="hidden" name="trainid" value="<?php echo $train_id ?>">

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Station Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter station name" required>
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

                <div class="modal-header">
                <h4 class="modal-title"><b>TIMINGS : </b></h4>
                </div><br>
                <div class="form-group">
                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>
                  <?php foreach($stmt1  as $row){ echo $row['name'] .' '. '-';} ?> </span> Path :</strong></h5></center>
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
                <center><h5 class="modal-title"><span style="color: blue";><strong>
                 <?php foreach($stmt2  as $row){ echo $row['name'] .' '. '-';} ?> </span> Path :</strong></h5></center>
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
                <label for="status" class="col-sm-3 control-label">Ticket Point?</label>
                 <br>
                    <div class="col-sm-9">
                      <input type="radio"  id="status" name="TicketPoint" required  value="1">Yes
                      <input type="radio"  id="status" name="TicketPoint" required value="0">No
                </div>
             </div>



<?php
if(true){


?>

             <div class="modal-header">
                <h4 class="modal-title"><b>PRICES :</b></h4>
                </div><br>

             <div class="form-group" >
                    <label for="name" class="col-sm-1 control-label"></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="price1" placeholder="Enter price for route between Khartoum station and this station" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-1 control-label"></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="price2" placeholder="Enter price for route between Atbara station and this station" required>
                    </div>
                </div>

<?php
}
?>








                
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
              <h4 class="modal-title"><b>Edit Station</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="station_edit.php">
                <?php 
                 $train_id = $_GET['id'];
                  $stmt = $conn->prepare("SELECT * FROM stations ");
                      $stmt->execute(array());
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
                <input type="hidden" class="userid" name="id">
                 <input type="hidden" name="trainid" value="<?php echo $train_id ?>">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Station Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter station name" required>
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

                <div class="modal-header">
                <h4 class="modal-title"><b>TIMINGS : </b></h4>
                </div><br>
                <div class="form-group">
                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>
                 <?php foreach($stmt1  as $row){ echo $row['name'] .' '. '-';} ?> </span> Path :</strong></h5></center>
                </div><br>

                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="edit_going_depart" name="DepartureTime1" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="edit_going_arriv" name="ArrivalTime1" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>
                <br>

                <div >
                <center><h5 class="modal-title"><span style="color: blue";><strong>
                 <?php foreach($stmt2  as $row){ echo $row['name'] .' '. '-';} ?> </span> Path :</strong></h5></center>
                </div><br>

                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Departure Time</label>

                    <div class="col-sm-3">
                      <input type="time" class="form-control" id="edit_return_depart" name="DepartureTime2" placeholder="Enter price for kh - at path" required>
                    </div>
                    <label for="price" class="col-sm-3 control-label">Arrival Time</label>

                    <div class="col-sm-3">
                      <input type="Time" class="form-control" id="edit_return_arriv" name="ArrivalTime2" placeholder="Enter price for at - kh path" required>
                    </div>
                </div>

                <div class="modal-header"></div>
                <br>

                <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Ticket Point?</label>
                 <br>
                    <div class="col-sm-9">
                      <input type="radio"  id="status" name="TicketPoint" required  value="1">Yes
                      <input type="radio"  id="status" name="TicketPoint" required value="0">No
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


     