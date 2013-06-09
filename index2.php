<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<?php
	if (empty($_POST['sex'])) echo'ft';
	if (!empty($_POST['name']) && !empty($_POST['sex']) && !empty($_POST['yuan']) && !empty($_POST['xi']) && !empty($_POST['xuehao']) && !empty($_POST['email']) && !empty($_POST['qq'])){
		$zoj=$_POST['zoj'];
		$poj=$_POST['poj'];
		$hdu=$_POST['hdu'];
		$zoj_tot=$_POST['zoj_tot'];
		$poj_tot=$_POST['poj_tot'];
		$hdu_tot=$_POST['hdu_tot'];
		$name=$_POST['name'];
		$sex=$_POST['sex'];
		$yuan=$_POST['yuan'];
		$xi=$_POST['xi'];
		$xuehao=$_POST['xuehao'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$qq=$_POST['qq'];
		$tot=$zoj_tot+$hdu_tot+$poj_tot;
		require_once 'conn.php';
		$sql="INSERT INTO xxx (zoj, poj, hdu, zoj_tot, poj_tot, hdu_tot, 
			name, sex, yuan, xi, xuehao, phone, email, qq, tot) VALUE 
			('$zoj', '$poj', '$hdu', '$zoj_tot', '$poj_tot', '$hdu_tot',
			 '$name', '$sex', '$yuan', '$xi', '$xuehao', '$phone', '$email', '$qq', '$tot')";
		mysql_query($sql, $con);
		echo '你的报名信息已经成功提交。';
	}
	else echo "非法访问！！";
?>
