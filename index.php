<?php
	require('includes/init.php');
	if(check_login()==true){
		header('location: chat/chat.php');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Pričalica</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="chat/chat.css">

		<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
		<!--script src="chat/chat.js" ></script-->
	</head>
	<body>
		<!-- simple login form -->
		<div class="container">
			<div class="form-position">
				<form action="login.php" method="post" name="Login_Form" class="form-signin">
				    <h3 class="form-signin-heading">Pričalica, prijavi se!</h3>
					  <hr class="colorgraph"><br>

					  <input type="text" class="form-control" name="user" placeholder="Id" required="true" autofocus="true" />
					  <input type="password" class="form-control" name="pass" placeholder="Zaporka" required="true"/>

					  <button class="btn btn-lg btn-primary btn-block" name="login" value="Login" type="submit">Prijava</button>
						<a href='reg.php'>Registriraj se</a>
				</form>
			</div>
		</div>
	</body>
</html>
