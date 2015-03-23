<div class="container-fluid">
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<div class="panel panel-danger">
			<div class="panel-heading" role="tab" id="systemReport">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> 
						Status of the emails sent from the system (Click to expand and collapse)
					</a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="systemReport">
				<div class="panel-body">
					<?php if(isset($campaigns) && $campaigns !== false) { ?>
						<div class="table-responsive">
							<table class="table table-condensed table-bordered" role="table">
								<thead>
									<tr>
										<th>Status</th>
										<th>Template Name</th>
										<th>List Name</th>
										<th>Total Subscribers</th>
										<th>Sent Emails</th>
										<th>Start Time</th>
										<th>End Time</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									foreach($campaigns as $campaign){ 
										if($campaign["progress"] === "3")
											$progress = "Complete";
										else if ($campaign["progress"] === "2")
											$progress = "In Progresss";
										else if ($campaign["progress"] === "1")
											$progress = "Queued";
										
										$subscriber_now = json_decode($campaign["subscriber"]);
										$sent_emails 	= json_decode($campaign["sent"]);
								?>
									<?php if($campaign["progress"] === "3"){ ?>
									<tr class="success">
									<?php } else if ($campaign["progress"] === "2"){ ?>
									<tr class="danger">
									<?php } else { ?>	
									<tr>
									<?php } ?>	
										<td><?php echo $progress; ?></td>
										<td><?php echo $campaign["template_name"]; ?></td>
										<td><?php echo $campaign["list_name"]; ?></td>
										<td><?php echo count($subscriber_now) + count($sent_emails); ?></td>
										<td><?php echo count($sent_emails); ?></td>
										<td><?php echo $campaign["start_time"]; ?></td>
										<td><?php echo $campaign["end_time"]; ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<div class="panel panel-danger">
			<div class="panel-heading" role="tab" id="headingTwo">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> 
						Monthly Statistics (Status for this month)
					</a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6 table-responsive">
							<table class="table table-condensed table-bordered">
								<caption class="text-center"> Current month's statistics</caption>
								<thead>
									<tr>
										<th>Delivered</th>
										<th>Open</th>
										<th>Click</th>
										<th>Fail</th>
										<th>Reject</th>
										<th>Spam</th>
										<th>Created</th>
										<th>Queued</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $metric["data"]["metrics"]["month"]["delivered"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["opened"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["clicked"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["failed"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["rejected"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["spammed"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["created"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["queued"]["current_value"]; ?></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-condensed table-bordered">
								<caption class="text-center"> Previous month's statistics</caption>
								<thead>
									<tr>
										<th>Delivered</th>
										<th>Open</th>
										<th>Click</th>
										<th>Fail</th>
										<th>Reject</th>
										<th>Spam</th>
										<th>Created</th>
										<th>Queued</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $metric["data"]["metrics"]["month"]["delivered"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["opened"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["clicked"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["failed"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["rejected"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["spammed"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["created"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["month"]["queued"]["previous_value"]; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-lg-6 graphs">
							<div class="col-sm-2">Delivered - <?php echo $metric["data"]["metrics"]["month"]["delivered"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["month"]["delivered"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Opened - <?php echo $metric["data"]["metrics"]["month"]["opened"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["month"]["opened"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Clicked - <?php echo $metric["data"]["metrics"]["month"]["clicked"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["month"]["clicked"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Failed - <?php echo $metric["data"]["metrics"]["month"]["failed"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["month"]["failed"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Rejected - <?php echo $metric["data"]["metrics"]["month"]["rejected"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["month"]["rejected"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Spammed - <?php echo $metric["data"]["metrics"]["month"]["spammed"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["month"]["spammed"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Created - <?php echo $metric["data"]["metrics"]["month"]["created"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["month"]["created"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Queued - <?php echo $metric["data"]["metrics"]["month"]["queued"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["month"]["queued"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-danger">
			<div class="panel-heading" role="tab" id="headingThree">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> 
						Weekly Statistics (Status for this week)
					</a>
				</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6 table-responsive">
							<table class="table table-condensed table-bordered">
								<caption class="text-center"> Current week's statistics</caption>
								<thead>
									<tr>
										<th>Delivered</th>
										<th>Open</th>
										<th>Click</th>
										<th>Fail</th>
										<th>Reject</th>
										<th>Spam</th>
										<th>Created</th>
										<th>Queued</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $metric["data"]["metrics"]["week"]["delivered"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["opened"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["clicked"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["failed"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["rejected"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["spammed"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["created"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["queued"]["current_value"]; ?></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-condensed table-bordered">
								<caption class="text-center"> Previous week's statistics</caption>
								<thead>
									<tr>
										<th>Delivered</th>
										<th>Open</th>
										<th>Click</th>
										<th>Fail</th>
										<th>Reject</th>
										<th>Spam</th>
										<th>Created</th>
										<th>Queued</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $metric["data"]["metrics"]["week"]["delivered"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["opened"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["clicked"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["failed"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["rejected"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["spammed"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["created"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["week"]["queued"]["previous_value"]; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-lg-6 graphs">
							<div class="col-sm-2">Delivered - <?php echo $metric["data"]["metrics"]["week"]["delivered"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["week"]["delivered"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Opened - <?php echo $metric["data"]["metrics"]["week"]["opened"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["week"]["opened"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Clicked - <?php echo $metric["data"]["metrics"]["week"]["clicked"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["week"]["clicked"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Failed - <?php echo $metric["data"]["metrics"]["week"]["failed"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["week"]["failed"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Rejected - <?php echo $metric["data"]["metrics"]["week"]["rejected"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["week"]["rejected"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Spammed - <?php echo $metric["data"]["metrics"]["week"]["spammed"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["week"]["spammed"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Created - <?php echo $metric["data"]["metrics"]["week"]["created"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["week"]["created"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Queued - <?php echo $metric["data"]["metrics"]["week"]["queued"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["week"]["queued"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-danger">
			<div class="panel-heading" role="tab" id="headingFour">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="headingFour"> 
						Hourly Statistics (Status for this hour)
					</a>
				</h4>
			</div>
			<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6 table-responsive">
							<table class="table table-condensed table-bordered">
								<caption class="text-center"> Current hour's statistics</caption>
								<thead>
									<tr>
										<th>Delivered</th>
										<th>Open</th>
										<th>Click</th>
										<th>Fail</th>
										<th>Reject</th>
										<th>Created</th>
										<th>Queued</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $metric["data"]["metrics"]["hour"]["delivered"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["opened"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["clicked"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["failed"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["rejected"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["created"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["queued"]["current_value"]; ?></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-condensed table-bordered">
								<caption class="text-center"> Previous hour's statistics</caption>
								<thead>
									<tr>
										<th>Delivered</th>
										<th>Open</th>
										<th>Click</th>
										<th>Fail</th>
										<th>Reject</th>
										<th>Created</th>
										<th>Queued</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $metric["data"]["metrics"]["hour"]["delivered"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["opened"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["clicked"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["failed"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["rejected"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["created"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["hour"]["queued"]["previous_value"]; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-lg-6 graphs">
							<div class="col-sm-2">Delivered - <?php echo $metric["data"]["metrics"]["hour"]["delivered"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["hour"]["delivered"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Opened - <?php echo $metric["data"]["metrics"]["hour"]["opened"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["hour"]["opened"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Clicked - <?php echo $metric["data"]["metrics"]["hour"]["clicked"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["hour"]["clicked"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Failed - <?php echo $metric["data"]["metrics"]["hour"]["failed"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["hour"]["failed"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Rejected - <?php echo $metric["data"]["metrics"]["hour"]["rejected"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["hour"]["rejected"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Created - <?php echo $metric["data"]["metrics"]["hour"]["created"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["hour"]["created"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Queued - <?php echo $metric["data"]["metrics"]["hour"]["queued"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["hour"]["queued"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-danger">
			<div class="panel-heading" role="tab" id="heading5">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="heading5"> 
						Daily Statistics (Status for today)
					</a>
				</h4>
			</div>
			<div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6 table-responsive">
							<table class="table table-condensed table-bordered">
								<caption class="text-center"> Today's statistics</caption>
								<thead>
									<tr>
										<th>Delivered</th>
										<th>Open</th>
										<th>Click</th>
										<th>Fail</th>
										<th>Reject</th>
										<th>Spam</th>
										<th>Created</th>
										<th>Queued</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $metric["data"]["metrics"]["date"]["delivered"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["opened"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["clicked"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["failed"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["rejected"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["spammed"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["created"]["current_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["queued"]["current_value"]; ?></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-condensed table-bordered">
								<caption class="text-center">Yesterday's statistics</caption>
								<thead>
									<tr>
										<th>Delivered</th>
										<th>Open</th>
										<th>Click</th>
										<th>Fail</th>
										<th>Reject</th>
										<th>Spam</th>
										<th>Created</th>
										<th>Queued</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $metric["data"]["metrics"]["date"]["delivered"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["opened"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["clicked"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["failed"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["rejected"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["spammed"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["created"]["previous_value"]; ?></td>
										<td><?php echo $metric["data"]["metrics"]["date"]["queued"]["previous_value"]; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-lg-6 graphs">
							<div class="col-sm-2">Delivered - <?php echo $metric["data"]["metrics"]["date"]["delivered"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["date"]["delivered"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Opened - <?php echo $metric["data"]["metrics"]["date"]["opened"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["date"]["opened"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Clicked - <?php echo $metric["data"]["metrics"]["date"]["clicked"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["date"]["clicked"]["current_value"]; ?>%"></div>
								</div>
							</div>
							<div class="col-sm-2">Failed - <?php echo $metric["data"]["metrics"]["date"]["failed"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["date"]["failed"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Rejected - <?php echo $metric["data"]["metrics"]["date"]["rejected"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["date"]["rejected"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Spammed - <?php echo $metric["data"]["metrics"]["date"]["spammed"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["date"]["spammed"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Created - <?php echo $metric["data"]["metrics"]["date"]["created"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["date"]["created"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
							<div class="col-sm-2">Queued - <?php echo $metric["data"]["metrics"]["date"]["queued"]["current_value"]; ?></div>
							<div class="col-sm-10">
								<div class="progress">
									<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $metric["data"]["metrics"]["date"]["queued"]["current_value"]; ?>%">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>