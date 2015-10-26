			
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="page-header">Price Detail</h1>
                </div>
                <div class="col-lg-4">
                	<div class="form-group col-lg-12">
                		<br>
							<label>Price Deail Id</label>
							<input class="form-control" id="search_id" name="search_id" value="<?=$priceDetailId ?>" />
					</div>
                </div>
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            General Info
                            <span style="float: right; margin: -7px 0 0 0"><button type="button" id="genericModal" class=" btn btn-info">Show Price Detail Response</button><div id="priceDetailResultQuery" style="display: none;"><?=json_encode($priceDetail); ?></div></span>
                        	<span style="float: right; margin: -7px 20px 0 0"><button type="button" id="genericModal" class=" btn btn-info">Show Price Detail Request</button><div id="priceDetailQuery" style="display: none;"><?=$priceDetailRequest; ?></div></span>
                        	
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        	<th>Total Price</th>
                                            <th>Currency</th>
                                            <th>Original Total Price</th>
                                            <th>Original Currency</th>
                                            <th>Recommended Extra</th>
                                            <th>Identity Type</th>
                                            <th>NonRefundable</th>
                                            <th>ClassChanged</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<th><?=$priceDetail -> totalPrice ?></th>
                                            <th><?=$priceDetail -> currency ?></th>
                                            <th><?=$priceDetail -> originalTotalPrice ?></th>
                                        	<th><?=$priceDetail -> originalCurrency ?></th>
                                            <th><?=$priceDetail -> recommendedExtra ?></th>
                                            <th><?=$priceDetail -> identityType ?></th>
                                            <th><?=$priceDetail -> nonRefundable ?></th>
                                            <th><?=$priceDetail -> classChanged ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
            
            
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Fare Info
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        	<th>Pax Type</th>
                                            <th>Pax Count</th>
                                            <th>Base Fare</th>
                                            <th>Tax</th>
                                            <th>Service Fee</th>
                                            <th>Supp.</th>
                                            <th>Agency Comm.</th>
                                            <th>Total</th>
                                            <th>Info</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	
                                    	<?php foreach($priceDetail->fares as $fare): ?>
                                    	
                                        <tr>
                                        	<th><?=$fare -> passangerType ?></th>
                                            <th><?=$fare -> passengerCount ?></th>
                                        	<th><?=$fare -> baseFare ?></th>
                                            <th><?=$fare -> tax ?></th>
                                            <th><?=$fare -> serviceFee ?></th>
                                            <th><?=$fare -> supplement ?></th>
                                            <th><?=$fare -> agencyCommission ?></th>
                                            <th><?=$fare -> total ?></th>
                                            
                                            <td>
                                            	<button type="button" id="genericModal" class="btn btn-outline btn-info">Info</button>
                                            	<div style="display: none"><?=json_encode($fare); ?></div> 
                                            </td>
                                        </tr>
                                        
                                        <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
			
			<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                	
                	
                	
                	
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ticketing
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <form role="form" id="makeTicketSubmitForm" action="<?=__SITE_PATH ?>/flight/makeTicket" method="POST">
                            
                            <input type="hidden" class="form-control" name="token" value="<?=$token ?>" />
                            
                            <div class="panel panel-green">
		                        <div class="panel-heading">
		                            Contact Parameters
		                        </div>
		                        <div class="panel-body">
		                        	
		                        	<div class="form-group col-lg-2">
											<label>Contact Email</label>
											<input class="form-control" name="contact_email" placeholder="Contact Email" value="<?=__USE_TICKETING_PARAMS ? $GLOBALS['TICKETING_PARAMS']->email : '';?>">
									</div>
									<div class="form-group col-lg-2">
											<label>Contact Gsm</label>
											<input class="form-control" name="contact_gsm" placeholder="Contact Gsm" value="<?=__USE_TICKETING_PARAMS ? $GLOBALS['TICKETING_PARAMS']->phone : '';?>">
									</div>
		                        	<div class="form-group col-lg-2">
											<label>Contact Phone</label>
											<input class="form-control" name="contact_phone" placeholder="Contact Phone" value="<?=__USE_TICKETING_PARAMS ? $GLOBALS['TICKETING_PARAMS']->phone : '';?>">
									</div>
		                        </div>
		                    </div>
                            
                            <div class="panel panel-info">
		                        <div class="panel-heading">
		                            Additional Parameters
		                        </div>
		                        <div class="panel-body">
		                        	<div class="form-group col-lg-2">
											<label>Contact Email</label>
											<input class="form-control" name="agency_extra" placeholder="Agency Extra" value="">
									</div>
									<div class="form-group col-lg-2">
											<label>Note</label>
											<textarea class="form-control" name="ticket_notes" placeholder="Notes"></textarea>
											
									</div>
		                        </div>
		                    </div>
                            
                            <div class="panel panel-yellow">
		                        <div class="panel-heading">
		                            Passenger Parameters
		                        </div>
		                        <div class="panel-body">
                            
										<div class="row">
											<input type="hidden" class="form-control" name="price_detail_id" value="<?=$priceDetailId ?>" />
											
											<textarea class="form-control" style="display:none;" name="price_detail_request" ><?=json_encode($priceDetailRequest); ?></textarea>
											<textarea class="form-control" style="display:none;" name="price_detail_response" ><?=json_encode($priceDetail); ?></textarea>
											
											<?php $paxCount = 0; ?>
											<?php foreach($priceDetail->fares as $fare): ?>
											<?php for($i = 0; $i < $fare->passengerCount; $i++): ?>
											<?php $paxCount++; ?>
											<div class="col-lg-12">
												<div class="form-group col-lg-2">
													<label>Name</label>
													<input class="form-control" name="name[]" placeholder="Name" value="TEST<?=$paxCount;?>">
												</div>
												<div class="form-group col-lg-2">
													<label>Surname</label>
													<input class="form-control" name="surname[]" placeholder="Surname" value="USER<?=$paxCount;?>">
												</div>
												<div class="form-group col-lg-2">
													<label>Birthdate</label>
													<input class="form-control" name="birthdate[]" placeholder="From Date" value="1980-01-01">
												</div>
												<div class="form-group col-lg-2">
													<label>Gender</label>
													<input class="form-control" name="gender[]" placeholder="Gender" value="MALE">
												</div>
												<div class="form-group col-lg-2">
													<label>Type</label>
													<input class="form-control" name="type[]" value="<?=$fare -> passangerType ?>" placeholder="Type" DISABLED>
												</div>
												<div class="form-group col-lg-2">
													
													<?php if($priceDetail->identityType == "TC_NO"): ?>
													<label>TC NO</label>
													<input class="form-control" name="tc_no[]" placeholder="TC NO">
													<?php endif; ?>
													
													<?php if($priceDetail->identityType == "PASSPORT"): ?>
													<label>Passport</label>
													<input class="form-control" name="passport_no[]" placeholder="No" value="CCa1234">
													<input class="form-control" name="passport_serial[]" placeholder="Serial" value="2222222">
													<input class="form-control" name="passport_issue_date[]" placeholder="Issue Date" value="2015-05-05">
													<input class="form-control" name="passport_end_date[]" placeholder="End Date" value="2021-05-05">
													<input class="form-control" name="passport_citizenhip_country[]" placeholder="Citizenship Country" value="TR">
													<input class="form-control" name="passport_issue_country[]" placeholder="Issue Country" value="TR">
													<?php endif; ?>
													
													<?php if($priceDetail->identityType == "FOID"): ?>
													<label>Foid</label>
													<input class="form-control" name="foid_no[]" placeholder="Foid No">
													<input class="form-control" name="foid_citizenhip_country[]" placeholder="Foid Citizenship Country">
													<?php endif; ?>
													
													
												</div>
												
											</div>
											<?php endfor; ?>
											<?php endforeach; ?>
										</div>
										
									
                            </div>
		                       
		                    </div>
		                    
		                    </form>
		                    
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
			
			
			
	<button type="button" id="makeTicketSubmit" class="btn btn-primary btn-lg btn-block">BOOK</button>
			
	<script>
		$("#makeTicketSubmit").click(function() {
			var form = $("#makeTicketSubmitForm");
			waitingDialog.show('Please Wait...');
			$.ajax({
				type : form.attr('method'),
				url : form.attr('action'),
				data : form.serialize()
			}).done(function(data) {
				
				$('#makeTicketTab').html(data);
				$("#makeTicketTabLink").click();
				waitingDialog.hide();
			}).fail(function() {
				waitingDialog.hide();
				alert("fail");
			});
	
		}); 
	</script>