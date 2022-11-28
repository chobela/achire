<!-- Add New -->

<div class="modal fade" id="addcomment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add Comment</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="comment.php">

				<input type="hidden" class="form-control" name="kam" value="<?php echo $name ?>">

	<input id="debtorid" type="hidden" class="form-control" name="debtorid" value="<?php echo $_GET['id']?>">
	<input id="debtorname" type="hidden" class="form-control" name="debtorname" value="<?php echo $drow['name']?>">
	<input id="user" type="hidden" class="form-control" name="user" value="<?php echo $id?>">
					 
                <div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Comment</label>
						</div>
				</div>


<div style="height:3px;"></div>



					<div class="row">
						<div class="col">
							<textarea id="comment" type="text" class="form-control" name="comment"> </textarea>
						</div>
					</div>


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
   