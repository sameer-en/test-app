
    <div class="panel panel-default mainpanel">
        <div class="panel-heading"><h4>Create/Update Expenses</h4></div>
        <div class="panel-body">


    <?php echo validation_errors(); ?>
    <?php echo form_open('',['method'=>'post','id'=>'form-exp','class'=>'form-horizontal']); ?>
             <!--   <form id="form-exp" class="form-horizontal"> -->
                    <div class="form-group">
                        <label for="userid" class="col-sm-2 control-label">Users Account</label>
                        <div class="col-sm-4">
                            <?php echo $form_users; ?>
                        </div>
                  
                        <label for="catid" class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-4">
                            <?php echo $form_cats; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-sm-2 control-label">Amount</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $form_data['amount'];?>">
                        </div>
                        <label for="expdate" class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="expdate" name="expdate" value="<?php echo $form_data['expdate'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" id="description" name="description"> <?php echo $form_data['description'];?></textarea> 
                        </div>
                        <label for="comment" class="col-sm-2 control-label">Comment</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" id="comment" name="comment"> <?php if(isset($form_data['Comment']) ) echo $form_data['Comment'] ; else echo '';?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exptype" class="col-sm-2 control-label">Expense Type and Status</label>
                        <div class="col-sm-4">
                                 <?php echo $form_exptypes; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <button type="submit" id="btn-submit" class="btn btn-primary">Save</button>
                            <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </form>
  </div>
    </div>
  
