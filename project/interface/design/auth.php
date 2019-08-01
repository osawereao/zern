<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $zern->linkToFile('favicon.ico');?>">
	<title><?php echo $zern->title();?></title>
	<style>html {visibility: hidden; opacity: 0;}</style>
	<link href="<?php echo $zern->linkToFile('fontawesome.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo $zern->linkToFile('main.css');?>" rel="stylesheet">
</head>

<body class="bg-dark">
	<div class="container">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">Login</div>
			<div class="card-body">
				<form id="oForm" name="oForm" class="form-signin" method="POST" action="<?php echo $zern->linkSelf();?>">
					<div class="form-group">
						<div class="form-label-group">
							<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
							<label for="inputEmail">Email address</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
							<label for="inputPassword">Password</label>
						</div>
					</div>
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox" value="remember-me">
							Remember Password </label>
						</div>
					</div>
					<a class="btn btn-primary btn-block" href="index.html">Login</a>
				</form>
				<div class="text-center"> <a class="d-block small mt-3" href="register.html">Register an Account</a> <a class="d-block small" href="forgot-password.html">Forgot Password?</a> </div>
			</div>
		</div>
	</div>

	<script src="<?php echo $zern->linkToFile('jquery.js');?>"></script>
	<script src="<?php echo $zern->linkToFile('bs.bundle.js');?>"></script>
	<script src="<?php echo $zern->linkToFile('easing.js');?>"></script>
</body>
</html>
