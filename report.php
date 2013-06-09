<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<h3>2013年郑州大学ACM集训队报名名单</h3>
<table width="100%">
<tr><td></td><td>姓名</td><td>OJ过题总数</td><td></td></tr>
<tr><td colspan="4"><hr/></td></tr>
<?php
	require_once 'conn.php';
	$result= mysql_query("SELECT * FROM xxx ORDER BY tot DESC");
	$i=0;
	while ($row = mysql_fetch_array($result)){
		$i++;
		echo '<tr><td width="40%" align="right">'.$i.'&nbsp; &nbsp; &nbsp; &nbsp;</td><td>'.$row['name']."</td><td>".$row['tot'] .'</td><td width="40%"></td></tr>';
	}
?>
</table>
<?php require_once 'footer.php';?>

</html>
