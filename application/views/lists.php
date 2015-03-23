<div class="container-fluid">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-danger">
			<!-- Default panel contents -->
			<div class="panel-heading text-center">
				Create / Upload Lists
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
						echo '<div class="text-center text-success">File Uploaded successfully</div><br />';
				?>
				<form class="form-horizontal" action="<?php echo base_url(); ?>login/upload_list_details" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="list_name">List Name * :</label>
						<div  class="col-sm-9">
							<input type="text" class="form-control" id="list_name" name="list_name" 
							required="required" placeholder="Provide the name of the list">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="list_desc">List Description * :</label>
						<div  class="col-sm-9">
							<textarea class="form-control" rows="3" id="list_desc" name="list_desc" required="required"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="file_name">File input * :</label>
						<div  class="col-sm-9">
							<input type="file" id="file_name" name="file_name" required="required">
							<p class="help-block">
								Please upload only a csv file. Other files will be rejected.
							</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-block btn-danger">
								Upload file and create lists
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
				My Lists and Statistics.
			</div>
			<div class="panel-body table-responsive">
				<table class="table table-condensed table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>List Name</th>
							<th>List Desc</th>
							<th>List Count</th>
							<th>Opened</th>
							<th>Failed</th>
							<th>Rejected</th>
							<th>Created</th>
							<th>Queued</th>
						</tr>
					</thead>
					<tbody>
						<?php $count=0; if(isset($list_data) && count($list_data)>0){ ?>
							<?php foreach($list_data as $list){ ?>
							<tr>
								<th scope="row"><?php echo $count+1;?></th>
								<td><?php echo $list["name"];?></td>
								<td><?php echo $list["des"];?></td>
								<td><?php echo $list["cnt"];?></td>
								<td>50</td>
								<td>20</td>
								<td>30</td>
								<td>1000</td>
								<td>11</td>
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

