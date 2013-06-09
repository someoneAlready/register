<?php
	require_once 'info.php';
	$con=mysql_connect($host, $user, $pwd);
	if (!$con)
		die('ft' . mysql_error());

	mysql_query("CREATE DATABASE $db_name DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci",$con);
	mysql_select_db($db_name, $con);
	$sql_xxx="CREATE TABLE xxx
	(
		id int NOT NULL AUTO_INCREMENT,
		zoj char(255),
		zoj_tot char(255),
		poj char(255),
		poj_tot char(255),
		hdu char(255),
		hdu_tot char(255),
		name char(255),
		tot int,
		sex int,
		xi char(255),
		yuan char(255),
		xuehao char(255),
		phone char(255),
		email char(255),
		qq char(255),
		PRIMARY KEY(id)
	)";
	mysql_query($sql_xxx, $con);
	mysql_close($con);
?>
