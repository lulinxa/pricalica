<?php
require('includes/config.php');

$user = $_POST['user'];
$enroll = $_POST['enroll'];
$pass = $_POST['pass'];
$re_pass = $_POST['re-pass'];

if($pass!=$re_pass) {
	header('location:reg.php?err=1');
} else {
	$sql = "SELECT null FROM stud_data WHERE usr_name='".$user."' OR usr_roll='".$enroll."'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count>0) {
		header('location:reg.php?err=2');
	} else {
		$sql = "INSERT INTO stud_data (usr_name,usr_roll,usr_pass) VALUES('".$user."','".$enroll."','".$pass."')";
		mysql_query($sql);
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
						<div class="alert alert-success">Uspiješno ste registrirani, <a href="index.php">Prijava</a></div>
					</div>
				</div>
			</body>
		</html>
<?php
	}
}
?>
