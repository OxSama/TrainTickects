<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Announcement</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="announcements_add.php" enctype="multipart/form-data">
               
              <div class="form-group">
                    <label for="subject" class="col-sm-3 control-label">Subject</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Message</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="message" name="message" required></textarea>
                    </div>
                </div>

                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-envelope"></i> Send</button>
              </form>
            </div>
        </div>
    </div>
</div>

