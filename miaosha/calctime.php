<?php
$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
$data=$pdo->query("select * from goods")->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $key => $val) {
	$starttime=time();
	$endtime=$val['endtime'];
	$remaintime=$endtime-$starttime;
	$hour=floor($remaintime/3600);//几个小时
	$minute=floor(($remaintime-$hour*3600)/60);//分钟
	$second=$remaintime-$hour*3600-$minute*60;//秒
	$data[$key]['hour']=$hour;
	$data[$key]['minute']=$minute;
	$data[$key]['second']=$second;
}
// echo "<pre>";
// print_r($data);
echo json_encode($data);
?>