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
					<?php echo oHTML::notify($auth);?>

					<div class="form-group">
						<div class="form-label-group">
							<input type="email" id="userid" name="userid" class="form-control" placeholder="Email address" value="<?php echo oInput::retain('userid');?>" required autofocus>
							<label for="userid">Email address</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
							<label for="inputPassword">Password</label>
						</div>
					</div>
					<div class="form-group">
						<div class="checkbox">
							<label><input type="checkbox" value="remember-me"> Remember Password </label>
						</div>
					</div>
					<button id="submitBTN" name="submitBTN" class="btn btn-primary btn-block" type="submit" tabindex="3">Login</button>
				</form>
				<div class="text-center"> <a class="d-block small mt-3" href="<?php echo $zern->linkTo('register');?>">Register an Account</a> <a class="d-block small" href="<?php echo $zern->linkTo('reset/password');?>">Forgot Password?</a> </div>
			</div>
		</div>
	</div>

	<script src="<?php echo $zern->linkToFile('jquery.js');?>"></script>
	<script src="<?php echo $zern->linkToFile('bs.bundle.js');?>"></script>
	<script src="<?php echo $zern->linkToFile('easing.js');?>"></script>
</body>
</html>
