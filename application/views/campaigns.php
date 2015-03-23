<div class="container-fluid">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-danger">
			<!-- Default panel contents -->
			<div class="panel-heading text-center">
				Create / Queue Campaigns
			</div>
			<div class="panel-body">
				<div class="text-center text-danger">
					<?php 
						echo validation_errors();
						// print_r($this->input->post());
						if(!empty($error))
							echo $error; 
					?>
				</div>
				<?php
					if(!empty($success) && $success)
						echo '<div class="text-center text-success">Campaign Queued Successfully</div><br />';
				?>
				<form class="form-horizontal" action="<?php echo base_url()?>login/queue_emails" method="post">
					<div class="form-group">
						<label for="template" class="col-sm-3 control-label">Select Template * :</label>
						<div class="col-sm-9">
							<select class="form-control" id="template" name="template" required="required">
								<option value="" selected="selected"></option>
								<?php //print_r($template_data); 
									if(isset($template_data) && count($template_data)>0) { 
										foreach ($template_data as $template){ 
											echo "<option value='".$template['id']."'>".$template['template_name']."</option>";
									 	} 
									} 
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="list" class="col-sm-3 control-label">Select Lists * :</label>
						<div class="col-sm-9">
							<select class="form-control" id="list" name="list" required="required">
								<option value="" selected="selected"></option>
								<?php //print_r($template_data); 
									if(isset($list_data) && count($list_data)>0) { 
										foreach ($list_data as $list){ 
											echo "<option value='".$list['id']."'>".$list['name']."</option>";
									 	} 
									} 
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-block btn-danger">
								Queue Emails for sending
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /container -->

