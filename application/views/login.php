<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Login</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/normalize.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/bootstrap.min.css">
		<script src="<?php echo base_url(); ?>resources/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	</head>
	<body>
		<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<div id = 'login-div' class="row">
			<div class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
				<form action="<?php echo base_url()?>login/validate" method="post" id='login_form'>
					<div class="text-center">Please provide your login details</div>
					<div class="error text-center" style="color:blue;">
						<?php 
							echo "<br />".validation_errors(); 
							if(isset($error)){
								echo $error;
							}
						?>
					</div>
					<div class="form-group">
						<label for="login_email">Email address</label>
						<input type="email" class="input-sm form-control" id="login_email" placeholder="Enter email" 
						required = "required" name="login_email" value="<?php echo set_value('login_email'); ?>">
					</div>
					<div class="form-group">
						<label for="login_password">Password</label>
						<input type="password" class="input-sm form-control" id="login_password" name="login_password" 
						required = "required" placeholder="Password" value="">
					</div>
					<br />
					<input type="submit" class="btn btn-danger btn-block input-sm ">
					<br />
					<small class="pull-right">Forgot Password?<a> Click here</a>.</small>
				</form>
			</div>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>resources/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
		<script src="<?php echo base_url(); ?>resources/js/vendor/jquery.validate.min.js"></script>
		<script>
			$("#login_form").validate({
	    		rules:{
	    			login_email: 	{required: true, email:true},
	    			login_password: {required: true, minlength:5},
	    		},
	    		messages:{
	    			login_email: 	{required: "<span style='color:blue'>Please provide your registered email address</span>", email:"<span style='color:blue'>Please provide a valid email address</span>"},
	    			login_password: {required: "<span style='color:blue'>Please provide a password</span>", minlength:"<span style='color:blue'>The password should have atleast 5 characters</span>"},
	    		},
    		});
		</script>
	</body>
</html>