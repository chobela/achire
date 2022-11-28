<!-- Add New -->

<div class="modal fade" id="addptp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add PTP</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addptp.php">

				<input type="hidden" class="form-control" name="kam" value="<?php echo $drow['firstname']?>">
                <input id="debtorname" type="hidden" class="form-control" name="debtorname" value="<?php echo $drow['name']?>">
				<input id="debtorid" type="hidden" class="form-control" name="debtorid" value="<?php echo $_GET['id']?>">
				<input id="user" type="hidden" class="form-control" name="user" value="<?php echo $id?>">


	

	
					 
<div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Amount</label>
						</div>
					</div>



<div style="height:3px;"></div>

					<div class="row">
						<div class="col">
							<input id="myamount" type="number" class="form-control" name="myamount">
						</div>
					</div>


					<div style="height:10px;"></div>

					<div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Promised Payment Date</label>
						</div>
					</div>



					<div style="height:3px;"></div>


				<div class="row">
						      <div class="col">
										  <div class="input-group date">
									                      <div class="input-group-addon">
									                       <i class="fa fa-calendar"></i>
									                      </div>
				<input autocomplete="off" type="text" data-date-format='yyyy-mm-dd' class="form-control pull-right" id="ptpdate" name="ptpdate">
									       </div>
			                  </div> 
				</div>


				


				<div style="height:10px;"></div>


 	<div style="height:10px;"></div>


                <div class="modal-footer">

        <button id="btn-pay" type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>

                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a></button>
                </div>

				</form>
                </div>
				
            </div>
        </div>
    </div>
</div>
   