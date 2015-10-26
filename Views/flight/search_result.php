<div class="row" style="padding: 15px;">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#flightResultTab" data-toggle="tab">Flight Search Result</a>
		</li>
		<li>
			<a href="#flightDebugTab" data-toggle="tab">Flight Debug Result</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="flightResultTab">
		<?php if(count($flights) > 0): ?>	
			<br/>
			<button type="button" class="priceDetailSubmitButton btn btn-primary btn-lg btn-block">GOTO PRICE DETAIL</button>
            
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="page-header">Search Results</h1>
                </div>
                <div class="col-lg-4">
                	<div class="form-group col-lg-12">
                		<br>
							<label>Search Id</label>
							<input class="form-control" id="search_id" name="search_id" value="<?=$searchId?>" DISABLED/>
					</div>
                </div>
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Departure Flights
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Provider/Operator</th>
                                            <th>Flight</th>
                                            <th>Route</th>
                                            <th>Time</th>
                                            <th>Price Type</th>
                                            <th>One Adult Price</th>
                                            <th>Package Allowed</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	
                                    	<?php foreach($flights as $flight): ?>
                                    	
                                    	<?php if($flight->returnFlight){ continue; } ?>
                                    	
                                        <?php $fares = $flight->fares; ?>
                                        
                                        <tr>
                                          
                                            <td>
                                            	<div class="radio">
	                                                <label>
	                                                    <input type="radio" name="departureRadios" id="departureRadios" data-flightid="<?=$flight->id?>" data-packageid="<?=$flight->packageId?>" data-providerkey="<?=$flight->providerKey?>">
	                                                </label>
                                            	</div>
                                            </td>
                                            <td class="ss">
                                            	<?php foreach($flight->legs as $leg): ?>
                                            		<?=$flight->providerKey?>/<?=$leg->operatorName?><br/>
                                            	<?php endforeach; ?>
                                            	
                                            </td>
                                            <td>
                                            	<?php foreach($flight->legs as $leg): ?>
                                            		<?=$leg->flightNo?><br/>
                                            	<?php endforeach; ?>
                                            </td>
                                            <td>
                                            	<?php foreach($flight->legs as $leg): ?>
                                            		<?=$leg->departureAirport?>:<?=$leg->arrivalAirport?> <br/>
                                            	<?php endforeach; ?>
                                            </td>
                                            <td>
                                            	<?php foreach($flight->legs as $leg): ?>
	                                            	<?=substr($leg->departureTime,11, 5)?>
                                            	<?php endforeach; ?>
                                            </td>
                                            <td><?=$flight->pricingType?> <br>  PackageId:<?=($flight->pricingType == "PACKAGED" ? $flight->packageId : "")?> </td>
                                            <td class="select_container">
                                            	<select class="form-control">
                                            		<?php foreach($fares as $fare): ?>
													<option value="<?=$fare->type;?>"><?=$fare->type;?> -> <?=$fare->totalSingleAdultFare . ' ' . $fare->currency;?></option>
													<?php endforeach; ?>
												</select>
                                            	
                                            	
                                            </td>
                                            <td>
                                            	<?php echo $flight->packageId == 0 ? '<button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i>' : '<button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i>' ; ?>
                                            	</td>
                                            <td>
                                            	<button type="button" id="genericModal" class="btn btn-outline btn-info">Info</button>
                                            	<div style="display: none"><?=json_encode($flight);?></div> 
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
                <!-- /.col-lg-6 -->
                

                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Return Flights
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Provider/Operator</th>
                                            <th>Flight</th>
                                            <th>Route</th>
                                            <th>Time</th>
                                            <th>Price Type</th>
                                            <th>One Adult Price</th>
                                            <th>Package Allowed</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	
                                    	<?php foreach($flights as $flight): ?>
                                    	
                                    	<?php if(!$flight->returnFlight){ continue; } ?>
                                    	
                                        <?php $fares = $flight->fares; ?>
                                        
                                        <tr>
                                          
                                            <td>
                                            	<div class="radio">
	                                                <label>
	                                                    <input type="radio" name="returnRadios" id="returnRadios" data-flightid="<?=$flight->id?>" data-packageid="<?=$flight->packageId?>" data-providerkey="<?=$flight->providerKey?>">
	                                                </label>
                                            	</div>
                                            </td>
                                           <td class="ss">
                                            	<?php foreach($flight->legs as $leg): ?>
                                            		<?=$flight->providerKey?>/<?=$leg->operatorName?><br/>
                                            	<?php endforeach; ?>
                                            	
                                            </td>
                                            <td>
                                            	<?php foreach($flight->legs as $leg): ?>
                                            		<?=$leg->flightNo?><br/>
                                            	<?php endforeach; ?>
                                            </td>
                                            <td>
                                            	<?php foreach($flight->legs as $leg): ?>
                                            		<?=$leg->departureAirport?>:<?=$leg->arrivalAirport?> <br/>
                                            	<?php endforeach; ?>
                                            </td>
                                            <td>
                                            	<?php foreach($flight->legs as $leg): ?>
	                                            	<?=substr($leg->departureTime,11, 5)?>
                                            	<?php endforeach; ?>
                                            </td>
                                            <td><?=$flight->pricingType?> <br>  PackageId:<?=($flight->pricingType == "PACKAGED" ? $flight->packageId : "")?> </td>
                                            <td class="select_container">
                                            	<select class="form-control">
                                            		<?php foreach($fares as $fare): ?>
													<option value="<?=$fare->type;?>"><?=$fare->type;?> -> <?=$fare->totalSingleAdultFare . ' ' . $fare->currency;?></option>
													<?php endforeach; ?>
												</select>
                                            	
                                            	
                                            </td>
                                            <td>
                                            	<?php echo $flight->packageId == 0 ? '<button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i>' : '<button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i>' ; ?>
                                            	</td>
                                            <td>
                                            	<button type="button" id="genericModal" class="btn btn-outline btn-info">Info</button>
                                            	<div style="display: none"><?=json_encode($flight);?></div> 
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
                <!-- /.col-lg-6 -->
                
            </div>
            <!-- /.row -->
			<button type="button" class="priceDetailSubmitButton btn btn-primary btn-lg btn-block">GOTO PRICE DETAIL</button>
			
		<?php else: ?>
			<div class="col-lg-6">No Result Found</div>
		<?php endif; ?>
	</div>
	<div class="tab-pane fade" id="flightDebugTab">
		<div class="col-lg-6">
		<pre>
		<?=$searchRequest?>
		</pre>
		</div>
		<div class="col-lg-6">
		<pre>
		<?=json_encode($searchResult, JSON_PRETTY_PRINT)?>
		</pre>
		</div>
		
	</div>

</div>
			
<script>
	
	$(".priceDetailSubmitButton").click(function(){
		
		var isRoundTrip = <?=$isRoundTrip ? "true":"false"?>;
		
		var departureSelected = $("input[type='radio'][name='departureRadios']:checked");
		var returnSelected = $("input[type='radio'][name='returnRadios']:checked");
		
		var departureProviderKey = departureSelected.data("providerkey");
		var departurePackageId = departureSelected.data("packageid");
		var departureflightId = departureSelected.data("flightid");
		
		if( !departureProviderKey  ){
			alert("Please select departure flight");
			return;
		}
		
		//TODO: pricingType değeri aynı mı olmalı
		
		var departurePricingType = departureSelected.parent().parent().parent().parent().find('.select_container').find('select').val();
		
		if(isRoundTrip){
			var returnProviderKey = returnSelected.data("providerkey");
			var returnPackageId = returnSelected.data("packageid");
			var returnflightId = returnSelected.data("flightid");
			
			if( !returnProviderKey  ){
				alert("Please select return flight");
				return;
			}
			
			if(departureProviderKey != returnProviderKey){
				$('#genericModal .modal-title').html('Error!');
		    	$('#genericModal .modal-body').html("You have selected " + departureProviderKey + " for departure and  " + returnProviderKey + " for return. <br>And you can not combine different providers. Please select same provider for departure and flight");
		    	$('#genericModal').modal('show');	
				return;
			}
			
			if(departurePackageId != returnPackageId){
				$('#genericModal .modal-title').html('Error!');
		    	$('#genericModal .modal-body').html("You have selected " + departurePackageId + " for departure and  " + returnPackageId + " for return. <br>Please select flights with the same packageId.");
		    	$('#genericModal').modal('show');
		    	return;
			}
			
			if(departurePackageId == 0){
				$('#genericModal .modal-title').html('Error!');
		    	$('#genericModal .modal-body').html("Not a packagable flight!");
		    	$('#genericModal').modal('show');
		    	return;
			}
			
			var returnPricingType = returnSelected.parent().parent().parent().parent().find('.select_container').find('select').val();
		}
		
		var searchId = $('#search_id').val();
		
		var searchQuery = $('#searchQuery').html();
		
		if(isRoundTrip){
			waitingDialog.show('Please Wait...');
			$.ajax({
		      type: "POST",
		      url: '<?=__SITE_PATH ?>/flight/priceDetail',
		      data: {departureFlightId:departureflightId, returnFlightId:returnflightId, departurePricingType:departurePricingType, returnPricingType:returnPricingType, searchId:searchId, searchQuery: searchQuery}
		    }).done(function(data) {
		    	
		    	$('#priceDetailTab').html(data);
		    	$("#priceDetailTabLink").click();
		    	waitingDialog.hide();
		    }).fail(function() {
		      	alert("fail");
		      	waitingDialog.hide();
		    });
		}else{
			waitingDialog.show('Please Wait...');
			$.ajax({
		      type: "POST",
		      url: '<?=__SITE_PATH ?>/flight/priceDetail',
		      data: {departureFlightId:departureflightId, departurePricingType:departurePricingType, searchId:searchId, searchQuery: searchQuery}
		    }).done(function(data) {
		    	
		    	$('#priceDetailTab').html(data);
		    	$("#priceDetailTabLink").click();
		    	waitingDialog.hide();
		    	
		    }).fail(function() {
		    	waitingDialog.hide();
		      	alert("fail");
		    });
		}
	});
	
</script>