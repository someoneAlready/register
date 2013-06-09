<?php
	require_once 'info.php';
	$con=mysql_connect($host, $user, $pwd);
	if (!$con)
		die('ft' . mysql_error());
	mysql_select_db($db_name, $con);
	mysql_query("SET NAMES 'UFT8'");
	mysql_query("SET CHARACTER SET UFT8");
?>
