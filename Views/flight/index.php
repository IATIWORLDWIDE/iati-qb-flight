<div class="row" style="padding-top: 10px;">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#flightSearchTab" data-toggle="tab">Flight Search</a>
		</li>
		<li>
			<a href="#priceDetailTab" id="priceDetailTabLink" data-toggle="tab">Price Detail</a>
		</li>
		<li>
			<a href="#makeTicketTab" id="makeTicketTabLink" data-toggle="tab">Make Ticket Result</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="flightSearchTab">
			
			<div class="row" style="margin-top:20px;">
				<div class="col-lg-12">
	
					<div class="panel panel-default">
						<div class="panel-heading">
							Flight Search
							<span style="float: right; margin: -7px 0 0 0">
								<button type="button" style="margin-right: 5px;" id="setOneWay" class=" btn btn-info">
									Set One Way Parameters
								</button>
								<button type="button" id="setRoundTrip" class=" btn btn-info">
									Set RoundTrip Parameters
								</button></span>
						</div>
						<div class="panel-body">
	
							<form role="form" id="flightSearchSubmitButton" action="<?=__SITE_PATH ?>/flight/search" method="POST">
								<div class="row">
									<div class="col-lg-12">
	
										<div class="form-group col-lg-3">
											<label>From Airport</label>
											<input id="fromAirport" class="form-control" name="fromAirport" placeholder="From Airport Code (Example Ayt)">
										</div>
										<div class="form-group col-lg-3">
											<label>To Airport</label>
											<input id="toAirport" class="form-control" name="toAirport" placeholder="To Airport Code (Example Ist)">
										</div>
										<div class="form-group col-lg-3">
											<label>From Date</label>
											<input class="form-control" name="fromDate" placeholder="From Date">
										</div>
										<div class="form-group col-lg-3">
											<label>Return Date</label>
											<input class="form-control" name="returnDate" placeholder="Return Date (if need)">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group col-lg-3">
											<label>Currency</label>
											<select class="form-control" name="currency">
												<option value="TL">TRY</option>
												<option value="USD">USD</option>
												<option value="EUR">EUR</option>
											</select>
										</div>
										<div class="form-group col-lg-3">
											<label>Class Type</label>
											<select class="form-control" name="classType">
												<option value=""></option>
												<option value="BUSINESS">BUSINESS</option>
												<option value="ECONOMY">ECONOMY</option>
											</select>
										</div>
	
										<div class="form-group col-lg-3">
											<div class="form-group col-lg-6">
												<label>Options</label>
												<div class="checkbox">
													<label>
														<input name="usePersonFares" type="checkbox" value="">
														Use Person Fares? </label>
												</div>
											</div>
											<div class="form-group col-lg-6">
												<label>&nbsp;</label>
												<div class="checkbox">
													<label>
														<input name="cip" type="checkbox" value="false">
														Is Cip? </label>
												</div>
											</div>
										</div>
										<div class="form-group col-lg-3">
											<div class="form-group col-lg-6">
												<label>Search all airports...</label>
												<div class="checkbox">
													<label>
														<input name="allinFromCity" type="checkbox" value="false">
														...in from City? </label>
												</div>
											</div>
											<div class="form-group col-lg-6">
												<label>&nbsp;</label>
												<div class="checkbox">
													<label>
														<input name="allinToCity" type="checkbox" value="false">
														...in to City? </label>
												</div>
											</div>
										</div>
									</div>
								</div>
	
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group col-lg-3">
											<label>Filter Providers</label>
											<input class="form-control" name="filterProviders" placeholder="Example: THY,SunExpress">
										</div>
										<div class="form-group col-lg-9">
											<div class="form-group col-lg-1">
												<label>Adult</label>
												<input class="form-control col-lg-1" value="1" name="adult" placeholder="Adult">
											</div>
											<div class="form-group col-lg-1">
												<label>Child</label>
												<input class="form-control col-lg-1" name="child" placeholder="Child">
											</div>
											<div class="form-group col-lg-1">
												<label>Infant</label>
												<input class="form-control col-lg-1" name="infant" placeholder="Infant">
											</div>
											<div class="form-group col-lg-1">
												<label>Senior</label>
												<input class="form-control col-lg-1" name="senior" placeholder="Senior">
											</div>
											<div class="form-group col-lg-1">
												<label>Student</label>
												<input class="form-control col-lg-1" name="student" placeholder="Student">
											</div>
											<div class="form-group col-lg-1">
												<label>Young</label>
												<input class="form-control col-lg-1" name="young" placeholder="Young">
											</div>
											<div class="form-group col-lg-1">
												<label>Military</label>
												<input class="form-control col-lg-1" name="military" placeholder="Military">
											</div>
											<div class="form-group col-lg-1">
												<label>Disable</label>
												<input class="form-control col-lg-1" name="disable" placeholder="Disable">
											</div>
										</div>
	
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group col-lg-3">
											<button type="submit" class="btn btn-default">
												SEARCH FOR FLIGHT(S)
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	
			<div id="searchResult"></div>
	
		</div>
		<div class="tab-pane fade" id="priceDetailTab">
			
		</div>
		<div class="tab-pane fade" id="makeTicketTab">
			
		</div>
	
	</div>

</div>

<script>

    $('#flightSearchSubmitButton').submit(function(event) {
	var form = $(this);
		waitingDialog.show('Please Wait...');
		$.ajax({
			type : form.attr('method'),
			url : form.attr('action'),
			data : form.serialize()
		}).done(function(data) {
			$("#searchResult").html(data);
			waitingDialog.hide();
		}).fail(function() {
			waitingDialog.hide();
			alert("fail");
		});
		event.preventDefault();
		// Prevent the form from submitting via the browser.
	});

 
    $( "#fromAirport, #toAirport" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "<?=__SITE_PATH?>/airport/autoComplete",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
          	// alert(data);
            // console.log(data);
            response($.map(data, function(item) {
                                return {
                                    label: item.name + ' | ' + item.cityName,
                                    id: item.code,
                                    value: item.code,
                                    abbrev: item.name + ' | ' + item.cityName
                                    };
                            }));

          },error: function( data ) {
          	// alert(data);
            // console.log(data);
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        $('#state_id').val(ui.item.id);
         $('#abbrev').val(ui.item.id);

      },
      open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
    });
	
	$("body").on("click", "#setOneWay", function(){
		$('input[name=fromAirport]').val("<?=$GLOBALS['SEARCH_PARAMS']->fromAirport?>");
		$('input[name=toAirport]').val("<?=$GLOBALS['SEARCH_PARAMS']->toAirport?>");
		$('input[name=fromDate]').val("<?=$GLOBALS['SEARCH_PARAMS']->fromDate?>");
		$('input[name=returnDate]').val("");
		$('input[name=adult]').val("<?=$GLOBALS['SEARCH_PARAMS']->adult?>");
		$('input[name=filterProviders]').val("");
	});
	
	$("body").on("click", "#setRoundTrip", function(){
		$('input[name=fromAirport]').val("<?=$GLOBALS['SEARCH_PARAMS']->fromAirport?>");
		$('input[name=toAirport]').val("<?=$GLOBALS['SEARCH_PARAMS']->toAirport?>");
		$('input[name=fromDate]').val("<?=$GLOBALS['SEARCH_PARAMS']->fromDate?>");
		$('input[name=returnDate]').val("<?=$GLOBALS['SEARCH_PARAMS']->returnDate?>");
		$('input[name=adult]').val("<?=$GLOBALS['SEARCH_PARAMS']->adult?>");
		$('input[name=filterProviders]').val("<?=$GLOBALS['SEARCH_PARAMS']->filterProviders?>");
	});
	
	$('input[name=fromAirport]').val("<?=$GLOBALS['SEARCH_PARAMS']->fromAirport?>");
	$('input[name=toAirport]').val("<?=$GLOBALS['SEARCH_PARAMS']->toAirport?>");
	$('input[name=fromDate]').val("<?=$GLOBALS['SEARCH_PARAMS']->fromDate?>");
	$('input[name=returnDate]').val("");
	$('input[name=adult]').val("<?=$GLOBALS['SEARCH_PARAMS']->adult?>");
	
  </script>
