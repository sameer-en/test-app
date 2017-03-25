    <div class="">
        <div class=""><h4>Notifications</h4></div>
        <div class="">
                   <div class="panel1 panel-default1" >
                        <div class="panel-heading1">
                            <h3 class="panel-title1" >
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                  Custom Filter :
                                </a>
                            </h3>
                        </div>
                       
                       <div class="panel-body panel-collapse collapse" id="collapseOne" >
                            <form id="form-filter" class="form-horizontal">
                                <div class="form-group">
                                    <label for="to_user_id" class="col-sm-2 control-label">To User </label>
                                    <div class="col-sm-4">
                                        <?php echo $dropdownToUsers; ?>
                                    </div>
                                    <label for="from_user_id" class="col-sm-2 control-label">From User </label>
                                    <div class="col-sm-4">
                                         <?php echo $dropdownFromUsers; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="noti_type" class="col-sm-2 control-label">Notification Type</label>
                                    <div class="col-sm-4">
                                        <?php echo $dropdownNotificationType; ?>
                                    </div>
                                     <label for="category" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-4">
                                        <?php echo $dropdownNotificationCategory; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="expdate" class="col-sm-2 control-label">Notification Date</label>
                                    <div class="col-sm-4">
                                         <input type="text" class="form-control" id="added_date" name="added_date">
                                    </div>
                                     <label for="expdate" class="col-sm-2 control-label">To Date</label>
                                    <div class="col-sm-4">
                                         <input type="text" class="form-control" id="added_date_to" name="added_date_to">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message" class="col-sm-2 control-label">Message</label>
                                    <div class="col-sm-4">
                                         <input type="text" class="form-control" id="message" name="message">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="LastName" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                                        <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                     <div id="lbl_total" class="listtotal"></div>
                    <table id="table" class="table table-striped table-bordered table-responsive table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>To User</th>
                                <th>From User</th>
                                <th>Category</th>
                                <th>Notification Type</th>
                                <th>Notification Date</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>To User</th>
                                <th>From User</th>
                                <th>Category</th>
                                <th>Notification Type</th>
                                <th>Notification Date</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

       </div>
    </div>
  
	
<script type='text/javascript'>
function showToastedMessages(options)
{
  toastr.options = options;
  <?php
  if(validation_errors())
  {
      $str = str_replace("\n","",validation_errors());
      echo "toastr.error('".$str."');";
  }
  if($this->session->flashdata('fl_type')=='success' &&  $this->session->flashdata('fl_message')!='')
  {
        echo "toastr.success('".$this->session->flashdata('fl_message')."');";
  }
?>
}   
</script>