
  
    <footer style="text-align: right;border-top:#ccc 1px solid;margin-top:10px;">
      <div class="container"  style="margin-top:10px;">
        &copy; Copyright <?=date('Y')?>. All rights reserved.
         </div>
    </footer>


    <!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
 -->
<!-- Modal -->
<div id="delModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete!</h4>
      </div>
      <div class="modal-body">
        <p>Do you want to delete this record?.</p>
        <input type="hidden" id="delid" name="delid" value="0" />
        <input type="hidden" name="delurl" id="delurl" value="" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="delete_record()" >Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>

  </div>
</div>
  </div> <!-- main container ends -->
<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/jquery/jquery-ui.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/common.js')?>"></script>
<?php 
if(isset($arr_js)) { 
foreach($arr_js as $src) { ?>
        <script src="<?php echo $src?>"></script>
<?php  } 
 } ?>
</body>
</html>