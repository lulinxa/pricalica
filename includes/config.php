<?php
  $con = mysql_connect('localhost', 'chat', 'chat');
   mysql_select_db("pricalica", $con);
   if (!$con) {
     die('Could not connect: ' . mysql_error());
   }
?>
