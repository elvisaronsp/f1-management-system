<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration - F1 System</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="register_style.css">

</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<div id="register-panel">
		<form method="post" action="register.php">

			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $email; ?>">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password_1">
			</div>
			<div class="form-group">
				<label>Confirm password</label>
				<input type="password" name="password_2">
			</div>
			<div class="form-group">	
				<button type="submit" class="btn" name="reg_user">Register</button>
			</div>
			<p>
				Already a member? <a href="login.php">Sign in</a>
			</p>
		</form>
	</div>
</body>
</html>