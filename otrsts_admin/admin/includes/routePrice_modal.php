<?php 
 $id = $_GET['id'];
 $stmt = $conn->prepare("SELECT * FROM stations ");
                      $stmt->execute(array());
                     ?>


<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Route Price</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="routePrice_edit.php">
                <input type="hidden" class="userid" name="id">
                <input type="hidden" class="form-control" name="trainid" value="<?php echo $id ?>">

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Price</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_price" name="price"  required>
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








     