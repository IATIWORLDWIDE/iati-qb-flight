<div class="row" style="padding-top: 30px;">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Airport List
				
				<span style="float: right; margin: -7px 0 0 0">
					<a href="<?=__SITE_PATH?>/airport/loadAirports" style="margin-right: 5px;" class=" btn btn-info">
						Load and Save Airport Data
					</a>
				</span>
				
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Code</th>
								<th>Airport Name</th>
								<th>City Code</th>
								<th>City Name</th>
								<th>Is Also City Code?</th>
								<th>Country Code</th>
								<th>Country Name</th>
							</tr>
						</thead>
						<tbody>
							<?php if(isset($airports) && is_array($airports) && count($airports) > 0): ?>
								
								<?php foreach($airports as $airport): ?>
								<tr>
									<td><?= $airport -> code; ?></td>
	                                <td><?= $airport -> name; ?></td>
	                                <td><?= $airport -> cityCode; ?></td>
	                                <td><?= $airport -> cityName; ?></td>
	                                <td><?=$airport -> city == true ? "YES" : "NO"; ?></td>
	                                <td><?= $airport -> countryCode; ?></td>
	                                <td><?= $airport -> countryName; ?></td>
								</tr>
								
								<?php endforeach; ?>
								
							<?php else: ?>
								<tr>
									<td colspan="7">No airport found. Please update database.</td>
								</tr>
							<?php endif; ?>
							
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