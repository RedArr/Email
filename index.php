<!DOCTYPE html>
<html>
<head>
<title>MOBAN</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="App Loction Form,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements"./>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
	$.post("do_email.php");
</script>

</script>
<!--webfonts-->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<?php
if (isset($_POST["email"])) {
    # code...
    $email = $_POST['email'];
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
    if(!preg_match($pattern, $email, $matches)){
        echo "<script>alert('请从新输入')</script>";
	}
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'email';
	$time = date("Y-m-d H:i:s");
	try{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
		$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM email_list WHERE useremail = '$matches[0]'";
		$date = $conn->query($sql);
		$row = $date->fetch(PDO::FETCH_BOTH);
		if (!empty($row)) {
			echo "<script>alert('已发送过 请查看邮箱是否被当作垃圾邮件');</script>";
		}else {
		$sql = "INSERT INTO Email_list (useremail,status,create_at,update_at)VALUES('$matches[0]','0','$time','$time')";
		$conn->exec($sql);
		echo "<script>alert('已加入队列')</script>";
		echo "<script>$.post('do_email.php');</script>";

		}

		}catch(PDOException $e){
			echo $sql."<br/>".$e->getMessage();
		}
	}
?>
</head>
<body>
	<h1>简历</h1>
		<div class="app-location">
			<h2>输入邮箱接收简历</h2>
			<div class="line"><span></span></div>
			<div class="location"><img src="images/location.png" class="img-responsive" alt="" /></div>
			<form action="./index.php" method="post" >
				<input type="text" name="email" class="text" value="E-mail address" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'E-mail address';}" >
				<div class="submit"><input type="submit" onClick="myFunction()" value="发送" ></div>
				<div class="clear"></div>
				<div class="new">
					<div class="clear"></div>
				</div>
			</form>
		</div>
	<!--start-copyright-->
	<!--//end-copyright-->
</body>
</html>