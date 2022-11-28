<!-- Add New -->
<?php

$ptpid = $_GET['ptpid'];

?>

<div class="modal fade" id="editptp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Edit PTP</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="editptp.php">

				<input type="hidden" class="form-control" name="kam" value="<?php echo $drow['firstname']?>">
                <input id="debtorname" type="hidden" class="form-control" name="debtorname" value="<?php echo $drow['name']?>">
				<input id="debtorid" type="hidden" class="form-control" name="debtorid" value="<?php echo $_GET['id']?>">
				<input id="user" type="hidden" class="form-control" name="user" value="<?php echo $id?>">
				<input id="ptpid" type="hidden" class="form-control" name="ptpid">


	

		       <div style="height:10px;"></div>

					<div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">PTP Status <?php echo $ptpid; ?></label>
						</div>
					</div>


                <div style="height:3px;"></div>


                    <div class="row">
						<div class="col">
							<select  id="status" name="status" class="form-control select2" style="position:relative; top:7px;">
								  <option value="0">--Select Status--</option>
			                      <option value="1">Broken</option>
			                      <option value="2">Cancelled</option>
			                      <option value="3">Closed</option>
			                      <option value="4">Collectible</option>
			                      <option value="5">Fulfilled</option>
			                      <option value="6">Pending</option>
			                </select>
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
   