<?php
$err = $_GET['err'];
$err_msg = "";
if($err != "") {
	switch($err) {
		// zero will never happen because required=true on input fields
		case 0: $err_msg = '<div class="alert alert-danger">Incomplete form</div>';
			break;
		case 1: $err_msg = '<div class="alert alert-danger">Passwords don\'t match</div>';
			break;
		case 2: $err_msg = '<div class="alert alert-danger">Already registered or try different username</div>';
			break;
		default:$err_msg = '';
			break;
	}
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
		<script src="chat/chat.js" ></script>
	</head>
	<body>
		<div class="container">
			<div class="wrapper">
				<span id="err_submit"><?php echo $err_msg; ?></span>
				<form action="submit.php" method="post" name="Register_Form" class="form-signin">
						<h3 class="form-signin-heading">Pričalica, registriraj se!</h3>
						<hr class="colorgraph"><br>

						<input type="text" class="form-control" name="user" placeholder="Username" required="true" autofocus="true" />
						<input type="text" class="form-control" name="enroll" placeholder="Enrollemnt" required="true"/>
						<input type="password" class="form-control" name="pass" placeholder="Password" required="true"/>
						<input type="password" class="form-control" name="re-pass" placeholder="Password again" required="true"/>

						<button class="btn btn-lg btn-primary btn-block" name="login" value="Register" type="submit">Register</button>
						<a href='index.php'>Login</a>
				</form>
			</div>
		</div>
	</body>
</html>
