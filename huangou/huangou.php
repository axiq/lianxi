<?php
$goods_id=$_GET['goods_id'];
$jifen=$_GET['jifen'];
session_start();
$id=$_SESSION['id'];
//用户积分，商品库存
$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
$res1=$pdo->exec("update good set stock=stock-1 where id=$goods_id");
$res2=$pdo->exec("update yonghu set integral=integral-$jifen where id=$id");
$g=$pdo->query("select name from good where id=$goods_id")->fetch(PDO::FETCH_ASSOC);
$goods_name=$g['name'];
$pdo->exec("insert into huandesc values(null,$id,$goods_id,'$goods_name',$jifen)");

echo "ok";
?>