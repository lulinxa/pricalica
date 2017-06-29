<?php
	require('../includes/init.php');
	if(!check_login()) {
		header('location: ../index.php');
	} else {
		$username = get_username();
		$enroll = get_enroll();
?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>Pričalica</title>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
			<link rel="stylesheet" type="text/css" href="chat.css">

			<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
			<script src="chat.js"></script>
		</head>
		<body>
			<div class="container">
				<div class="header clearfix">
					<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
						<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					    <span class="navbar-toggler-icon"></span>
					  </button>
						<a class="navbar-brand" href="/">Pričalica</a>
						<div class="collapse navbar-collapse pull-right" id="navbarSupportedContent">
					    <ul class="nav nav-pills mr-auto">
					      <li class="nav-item">
					        <a class="nav-link" href="../logout.php">Odjava</a>
					      </li>
							</ul>
							<span class="navbar-text float-right"><?php echo "Dobrodošao, ".$username; ?></span>
					</nav>
				</div>

				<hr class="colorgraph" ><br>

				<div class="row">
					<div id="onlinetitle" class="col-4">Online Korisnici</div>
					<div id="chatboxtitle" class="col-8">Pričalica</div>
				</div>

				<div class="row">
			    <div class="col-4">
						<ul class="list-group small" id="users-list">
							<!-- dynamically filled with show_online.php -->
						</ul>
			    </div>
			    <div class="col-8">
						<div id="chatbox" class="left_border">
							<!-- dynamically filled chat.js -->
						</div>
			    </div>
				</div>

			</div>

		</body>
	</html>
<?php
	}
?>
