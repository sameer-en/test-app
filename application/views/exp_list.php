
 
    <div class="panel panel-default mainpanel">
        <div class="panel-heading"><h4>List All Expenses</h4></div>
        <div class="panel-body">
                   <div class="panel panel-default" >
                        <div class="panel-heading">
                            <h3 class="panel-title" >
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                  Custom Filter :
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body panel-collapse collapse" id="collapseOne" >
                            <form id="form-filter" class="form-horizontal">
                                <div class="form-group">
                                    <label for="country" class="col-sm-2 control-label">Users Account</label>
                                    <div class="col-sm-4">
                                        <?php echo $form_users; ?>
                                    </div>
                               
                                    <label for="country" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-4">
                                        <?php echo $form_cats; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="col-sm-2 control-label">Amount</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="amount" name="amount">
                                    </div>
                               
                                    <label for="exptype" class="col-sm-2 control-label">Expense Type and Status</label>
                                    <div class="col-sm-4">
                                         <?php echo $form_exptypes; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="expdate" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-4">
                                         <input type="text" class="form-control" id="expdate" name="expdate">
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
                    <table id="table" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Account name</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Account name</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

       </div>
    </div>
  
