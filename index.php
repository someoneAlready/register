<?php
			echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
	function gao($s, &$i){
		$ret=0;
		while ($i<strlen($s) && ($s[$i]<'0' || $s[$i]>'9')) $i++;
		while ($i<strlen($s) && $s[$i]>='0' && $s[$i]<='9'){
			$ret=$ret*10+$s[$i]-'0';
			$i++;
		}
		return $ret;
	}

	if (!empty($_POST['zoj']) || !empty($_POST['poj']) || !empty($_POST['hdu'])){
		$zoj=$_POST['zoj'];
		$zoj_pwd=$_POST['zojpwd'];
		$poj=$_POST['poj'];
		$poj_pwd=$_POST['pojpwd'];
		$hdu=$_POST['hdu'];
		$hdu_pwd=$_POST['hdupwd'];
		$zoj_tot=0; $zoj_ok=0; $hdu_tot=0; $hdu_ok=0; $poj_tot=0;
		if ($zoj && login_zoj($zoj, $zoj_pwd)){
			$file = fopen("http://acm.zju.edu.cn/onlinejudge/showRuns.do?contestId=1&search=true&firstId=-1&lastId=-1&problemCode=&handle=$zoj&idStart=&idEnd=", 'r');
			$a=array(1037, 2818, 1049, 1048, 1760, 1755, 1195, 1113, 1051,
1151, 2969, 1045, 2970, 2987, 2988, 1115, 1874, 2722,
1067, 1331, 1242, 1292, 1251, 1216, 2835, 1241, 1240,
1350, 1016, 1712, 1489, 1205, 1382, 1405, 1414, 1494,
2104, 2201, 2886, 2176);

			while (!feof($file)){
				$s=fgets($file);
				if (stristr($s, "onlinejudge/showUserStatus.do")){
					$i=0;
					$id=gao($s, $i);
					$f2=fopen("http://acm.zju.edu.cn/onlinejudge/showUserStatus.do?userId=$id", "r");
					$flag=false;
					while (!feof($f2)){
						$l=fgetss($f2);
						if (stristr($l, 'Solved Problems:')) $flag=true;
						if (stristr($l, 'Copyright')) $flag=false;
						if ($flag){
							$i=0;
							$k=gao($l, $i);
							if ($k>999 && $k<4000){ if (in_array($k, $a)) $zoj_ok++;
								$zoj_tot++;
							}

						}
					}
					break;
				}
			}
			
		}
		if ($poj && login_poj($poj, $poj_pwd)){
			$file = fopen("http://poj.org/userstatus?user_id=$poj","r");
			$s='';
			while (!feof($file)){
				$p=$s;
				$s=fgetss($file);
				if (stristr($p, "Solved")){
					$i=0;
					$poj_tot=gao($s, $i);
				}
			}	
		}
		if ($hdu && login_hdu($hdu, $hdu_pwd)){
			$file = fopen("http://acm.hdu.edu.cn/userstatus.php?user=$hdu", "r");
			$s='';
			while (!feof($file)){
				$p=$s;
				$s=fgetss($file);
				if (stristr($s, "problems solved")){
					$i=0;
					$hdu_tot=gao($s, $i);
				}
				else if (stristr($p, "list of solved problems")){
					for ($i=0; $i<strlen($s); ++$i){
						$k=gao($s, $i);
						if ($k>=1089 && $k<=1096) $hdu_ok++;
						else if ($k>=2000 && $k<=2020) $hdu_ok++;
					}

				}
			}	
		}
		echo "<p>你完成ZOJ $zoj_tot 道，完成POJ $poj_tot 道，完成HDU $hdu_tot 道</p>";
		echo "<p>完成新手任务ZOJ $zoj_ok 道，完成新手任务HDU $hdu_ok 道。</p>";
		if ($hdu_ok==29 && $zoj_ok>=30){
			echo '恭喜你，已完成新手任务！';
			echo '
				<hr/>

			<script type="text/javascript">
			function CheckForm(objForm){				 
				if (objForm.name.value=="" || objForm.sex.value=="" || objForm.yuan.value=="" ||
						objForm.xi.value=="" || objForm.xuehao.value=="" || objForm.phone.value=="" ||
						objForm.email.value=="" || objForm.qq.value==""){
					alert("you have to complete some message...");
					return false;
				}
				return true;
			}
			</script>			

				<p>请将下了信息填写完整后提交</p>
				<table width="100%" id="contentss" >
			<form  name="form1" method="post" action="index2.php">
				<input type="hidden" name="zoj" value="'.$zoj.'">
				<input type="hidden" name="poj" value="'.$poj.'">
				<input type="hidden" name="hdu" value="'.$hdu.'">
				<input type="hidden" name="zoj_tot" value="'.$zoj_tot.'">
				<input type="hidden" name="poj_tot" value="'.$poj_tot.'">
				<input type="hidden" name="hdu_tot" value="'.$hdu_tot.'">

				<tr><td align="right" width="42%">姓名</td><td> <input name="name" type="text"/></td><tr>
				<tr><td align="right">性别</td><td><select size=1 name="sex"><option value=1>男</option><option value=2>女</option></select> </td></tr>
				<tr><td align="right" width="42%">学院</td><td>  <input name="yuan" type="text"/></td><tr>
				<tr><td align="right" width="42%">专业</td><td>  <input name="xi" type="text"/></td><tr>
				<tr><td align="right" width="42%">学号</td><td>  <input name="xuehao" type="text"/></td><tr>

				<tr><td align="right">电话</td><td><input name="phone" type="text"/></td></tr>
				<tr><td align="right">E-mail</td><td><input name="email" type="text"/></td></tr>
				<tr><td align="right">QQ</td><td><input name="qq" type="text"/></td></tr>
				<tr><td></td><td><input name="submit" type="submit" value="Submit" onClick="javaScript:return CheckForm(form1)"/>&nbsp; <input type="reset" value="Reset"/></td><tr>
			</form>	
			</table>			
			';
			require_once 'footer.php';
			exit() ;
		}
		else{
			echo '你未完成新手任务';
		}
	}
?>
<?php
	function login_zoj($id, $pwd){
		$data = array ('handle' => "$id", 'password' => "$pwd");
		$data = http_build_query($data);
		$opts = array (
		    'http' => array (
		        'method' => 'POST',
		        'header'=> "Content-type: application/x-www-form-urlencoded\r\n" .
       			"Content-Length: " . strlen($data) . "\r\n",
		        'content' => $data
   			 )
		);
		$context = stream_context_create($opts);
		$html = file_get_contents('http://acm.zju.edu.cn/onlinejudge/login.do', false, $context);
		list($version,$status_code,$msg) = explode(' ',$http_response_header[0], 3);
		if ($status_code==302) return true;
		return false;
	}
	function login_poj($id, $pwd){
		$data = array ('user_id1' => "$id", 'password1' => "$pwd", "B1"=>"login", "url"=>"/");
		$data = http_build_query($data);
		$opts = array (
		    'http' => array (
		        'method' => 'POST',
		        'header'=> "Content-type: application/x-www-form-urlencoded\r\n" .
       			"Content-Length: " . strlen($data) . "\r\n",
		        'content' => $data
   			 )
		);
		$context = stream_context_create($opts);
		$html = file_get_contents('http://poj.org/login', false, $context);
		list($version,$status_code,$msg) = explode(' ',$http_response_header[0], 3);
		if (stristr($html, 'Log Out')) return true;
		return false;
	}
		
	function login_hdu($id, $pwd){
		$data = array ('username' => "$id", 'userpass' => "$pwd");
		$data = http_build_query($data);
		$opts = array (
		    'http' => array (
		        'method' => 'POST',
		        'header'=> "Content-type: application/x-www-form-urlencoded\r\n" .
       			"Content-Length: " . strlen($data) . "\r\n",
		        'content' => $data
   			 )
		);
		$context = stream_context_create($opts);
		$html = file_get_contents('http://acm.hdu.edu.cn/userloginex.php?action=login', false, $context);
		list($version,$status_code,$msg) = explode(' ',$http_response_header[0], 3);
		if ($status_code==302) return true;
		return false;
	}
?>
<h3>2013年郑州大学ACM集训队报名须知</h3>
<p>	暑期集训由通过完成OJ上的<a href="x.php" target="_blank">新手任务</a>自愿报名，一旦报名，原则上不允许中途退出。请本着对自己和所有人负责的态度参加暑期集训。计算机相关专业的同学可以用暑期集训充当短学习，其它学院的同学也可以用暑期集训作为个性课程。
</p>

<p>已报名的名单 <a href="report.php" target="_blank">report</a>
</p>

<hr/>
<p>
如果你已经完成新手任务，请在下方填写你各个OJ的帐号和密码，程序会检测你是否完成新手任务。如果你完成新手任务，就会自动转到报名页面。
</P>

<div style="width:960px; margin:0 auto;">
<table width="100%" align="center" >
<form action="" method="post">
<tr width="100%"><td align="right" width="25%">ZOJ ID:</td><td width="25%" align="left"><input type="text" name="zoj" value="<?php echo $zoj?>"/></td>
	<td align="left" width="13%">ZOJ Password:</td><td width="37%" align="left"><input type="password" name="zojpwd" value="<?php echo $zoj_pwd?>"></td></tr>

<tr><td align="right">POJ ID:</td><td align="left"><input type="text" name="poj" value="<?php echo $poj?>"/></td>
	<td align="left">POJ Password:</td><td align="left"><input type="password" name="pojpwd" value="<?php echo $poj_pwd?>"></td></tr>

<tr><td align="right">HDU ID:</td><td align="left"><input type="text" name="hdu" value="<?php echo $hdu?>"/></td>
	<td align="left">HDU Password:</td><td align="left"><input type="password" name="hdupwd" value="<?php echo $hdu_pwd?>"></td></tr>
<tr><td align="center" colspan="4"><input type="submit" value="submit"/>&nbsp; &nbsp;<input type="reset" value="reset"/></td></tr>

</form>
</table>
</div>
<?php require_once 'footer.php'?>
</html>
