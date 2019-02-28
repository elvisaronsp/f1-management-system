<?php include("db-connection.php");

	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>F1 System</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- Font awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php"><i class="fas fa-car"></i>  F1</a>
			</div>
			<ul class="nav navbar-nav" style="margin-left: 20px">
				<li><a href="index.php">Status turnee</a></li>
				<li><a href="pilots-panel.php">Panou piloti</a></li>
				<li><a href="races-panel.php">Panou curse</a></li>
				<li><a href="tournaments-panel.php">Panou turnee</a></li>
				<li><a href="statistics.php">Statistici</a></li>
				<?php 
					if (isset($_SESSION['username'])) {
						echo "</ul>
							  <ul class='nav navbar-nav' style='float: right'>
            					 <li><a class='navbar-nav pull-right'>Logged in as <strong> ".$_SESSION['username']." <i class='fas fa-user-ninja fa-lg'></i></strong></a></li>
            					 <li><a href='index.php?logout='1'' style='color: white;'>Logout</a></li>";
					}
				?>
			</ul>
		</div>
	</nav>
