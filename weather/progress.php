<?php
$redis=new Redis;
$redis->connect("127.0.0.1",6379);
$area=$_GET['area'];
if($redis->exists($area)){
	$str=$redis->get($area);
	//echo "from redis";
	echo $str;
}
else{
	$key='046d0a349f1b41bd92ebb048305978f2';
	$url="https://free-api.heweather.com/s6/weather/forecast?location=$area&key=$key";
	$str=curl_get($url);
	//echo $str;
	$data=json_decode($str,true);
	// echo "<pre>";
	// print_r($data);
	$data=$data['HeWeather6'][0]['daily_forecast'];
	// echo "<pre>";
	// print_r($data);
	$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
	foreach ($data as $key => $val) {
		$date=$val['date'];
		$tmp_max=$val['tmp_max'];
		$tmp_min=$val['tmp_min'];
		$sql="insert into weather values(null,'$area','$tmp_max','$tmp_min','$date')";
		echo $sql;
		$res=$pdo->exec($sql);
		
	}
	$str=json_encode($data);
	$redis->set($area,$str);
	//echo "from mysql";
	echo $str;
}



function curl_get($url){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$str=curl_exec($ch);
	curl_close($ch);
	return $str;
}
?>