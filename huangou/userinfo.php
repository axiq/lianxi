<?php
session_start();
$id=$_SESSION['id'];
$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
$res=$pdo->query("select * from yonghu where id=$id")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<font>尊敬的<?php echo $res['name']?></font>
	<font>您拥有的积分:<?php echo $res['integral']?></font>
	<h3><a href="show.php">换购列表</a></h3>
	<h3><a href="desc.php">换购详情页</a></h3>
</body>
</html>