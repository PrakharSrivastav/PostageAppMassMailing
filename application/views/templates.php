<div class="container-fluid">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-danger">
			<!-- Default panel contents -->
			<div class="panel-heading text-center">
				Add Template Details
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
						echo '<div class="text-center text-success">Template Created successfully</div><br />';
				?>
				<form class="form-horizontal" method="post" action="<?php echo base_url()?>login/upload_template_details">
					<div class="form-group">
						<label class="col-sm-4 control-label" for="template_name">Template Name * :</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="template_name" name="template_name" required="required" 
							placeholder="Provide the name of the template as in postage app">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="template_desc">Template Description:</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="3" id="template_desc" name="template_desc"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<button type="submit" class="btn btn-block btn-danger">
								Save Template details
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-danger">
			<!-- Default panel contents -->
			<div class="panel-heading text-center">
				Template details.
			</div>
			<div class="panel-body table-responsive">
				<table class="table table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Template Name</th>
							<th>Template Desc</th>
						</tr>
					</thead>
					<tbody>
						<?php $count=0; if(isset($template_data) && count($template_data)>0){ ?>
							<?php foreach($template_data as $template){ ?>
							<tr>
								<th scope="row"><?php echo $count+1;?></th>
								<td><?php echo $template["template_name"];?></td>
								<td><?php echo $template["template_desc"];?></td>
							</tr>
							<?php $count++;} ?>
						<?php  } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- /container -->

