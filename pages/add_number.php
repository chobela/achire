<!-- Add New -->

<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add New</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="newpromo.php">
					 
<div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Promo Title</label>
						</div>
					</div>


<div style="height:3px;"></div>



					<div class="row">
						<div class="col">
							<input type="text" class="form-control" name="title">
						</div>
					</div>


					<div style="height:10px;"></div>


<div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Message</label>
						</div>
					</div>



<div style="height:3px;"></div>


					<div class="row">
						<div class="col">				
							<textarea maxlength="160" type="text" class="form-control" name="message"></textarea>
						</div>
						<div><p id="chars">160</p></div>
					</div>


					<div style="height:10px;"></div>



					<div class="row">
						<div class="col">
							<label class="control-label" style="position:relative; top:7px;">Date</label>
						</div>
					</div>



					<div style="height:3px;"></div>


				<div class="row">
						      <div class="col">
										  <div class="input-group date">
									                      <div class="input-group-addon">
									                       <i class="fa fa-calendar"></i>
									                      </div>
									                         <input type="text" data-date-format='yyyy-mm-dd' class="form-control pull-right" id="date" name="date">
									       </div>
			                  </div> 
				</div>


				<div style="height:10px;"></div>


							<div class="row">
											<div class="col">
												<label class="control-label" style="position:relative; top:7px;">Time</label>
											</div>
							</div>



				<div style="height:3px;"></div>



<div class="row">
					      <div class="col">
										    <div class="input-group timepicker">
						                      <div class="input-group-addon">
						                       <i class="fa fa-clock-o"></i>
						                      </div>
						                          <input type="text" class="form-control time"  id="time" name="time">
						                    </div>        
						   </div>
</div>


 	<div style="height:10px;"></div>


                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>

                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a></button>
                </div>

				</form>
                </div>
				
            </div>
        </div>
    </div>
</div>

