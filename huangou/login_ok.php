<?php
$name=$_POST['name'];
$pwd=md5($_POST['pwd']);
$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
$res=$pdo->query("select * from yonghu where name='$name' and pwd='$pwd'")->fetch(PDO::FETCH_ASSOC);
session_start();
$_SESSION['id']=$res['id'];
if($res){
	echo "<script>alert('登录成功');location.href='userinfo.php'</script>";
}
else{
	echo "<script>alert('用户名或密码错误');location.href='index.html'</script>";
}
?>