<?php
require('../includes/init.php');
if(check_login()==true) {

	$enroll = get_enroll();

	//updating the time
	$sql = "UPDATE stud_data SET time=".time()." WHERE usr_roll=".$enroll;
	mysql_query($sql);

	// getting online users
	$time = time()-3;
	$sql = "SELECT usr_name, usr_roll FROM stud_data WHERE time>=".$time." AND usr_roll<>".$enroll;
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count>0) {
		while($row = mysql_fetch_assoc($result)) {
			echo "<a href='#' class='list-group-item list-group-item-action' id='user-".$row['usr_name']."' onclick='javascript:chatWith(&#39;".$row['usr_name']."&#39;,".$row['usr_roll'].")'>".$row['usr_name']."</a>";
		}
	}
} else {
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
				<div class="wrapper">
					<div class="alert alert-error">Invalid Username/Password, please <a href='../'>login </a>again</div>
				</div>
			</div>
		</body>
	</html>
<?php
}
?>
