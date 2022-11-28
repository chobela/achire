<!-- Add New -->

<div class="modal fade" id="addpayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add Payment</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="pay.php">

				<input type="hidden" class="form-control" name="kam" value="<?php echo $drow['firstname']?>">

				<input id="debtorid" type="hidden" class="form-control" name="debtorid" value="<?php echo $_GET['id']?>">
				<input id="debtorname" type="hidden" class="form-control" name="debtorname" value="<?php echo $drow['name']?>">
				<input id="user" type="hidden" class="form-control" name="user" value="<?php echo $id?>">

	
					 
<div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;" autocomplete="off">Amount</label>
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
							<label class="control-label" style="position:relative; top:7px;">Payment Type</label>
						</div>
					</div>


       <div style="height:3px;"></div>


                    <div class="row">
						<div class="col">
							<select  id="type" name="type" class="form-control select2" style="position:relative; top:7px;">
			                      <option value="1">Collection</option>
			                      <option value="2">Dispute</option>
			                      <option value="3">Write Off</option>
			                      <option value="4">Hand Back</option>
			                      <option value="5">Demand Fee</option>
			                </select>
						</div>
					</div>

					<div style="height:10px;"></div>

					<div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Transaction Type</label>
						</div>
					</div>


                 <div style="height:3px;"></div>


                    <div class="row">
						<div class="col">
							<select  id="transtype" name="transtype" class="form-control select2" style="position:relative; top:7px;">
			                      <option value="1">Cash Payment</option>
			                      <option value="2">Airtel Money to Suspense Acc</option>
			                       <option value="3">Bank Deposit</option>
			                       <option value="4">MTN to suspense Acc</option>
			                       <option value="5">PMEC</option>
			                       <option value="6">Deduction from Customer Acc</option>
			                  
			                </select>
						</div>
					</div>




					<div style="height:10px;"></div>

					<div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Payment Date</label>
						</div>
					</div>



					<div style="height:3px;"></div>


				<div class="row">
						      <div class="col">
										  <div class="input-group date">
									                      <div class="input-group-addon">
									                       <i class="fa fa-calendar"></i>
									                      </div>
				<input autocomplete="off"  type="text" data-date-format='yyyy-mm-dd' class="form-control pull-right" id="mydate" name="mydate">
									       </div>
			                  </div> 
				</div>


					<div style="height:10px;"></div>

					<div class="row">
						<div class="col">
							<label autocomplete="off" class="control-label" style="position:relative; top:7px;">Next Payment Date</label>
						</div>
					</div>



					<div style="height:3px;"></div>


				<div class="row">
						      <div class="col">
										  <div class="input-group date">
									                      <div class="input-group-addon">
									                       <i class="fa fa-calendar"></i>
									                      </div>
				<input  type="text" data-date-format='yyyy-mm-dd' class="form-control pull-right" id="nextdate" name="nextdate">
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
   