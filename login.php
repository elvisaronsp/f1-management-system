<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - F1 System</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Login</h2>
	</div>
	<div id="login-panel">
		<form method="POST" action="login.php">

			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" >
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password">
			</div>
			<div class="form-group">
				<button type="submit" class="btn" name="login_user">Login</button>
			</div>
			<p>
				Not yet a member? <a href="register.php">Sign up</a>
			</p>
		</form>
	</div>

</body>
</html>