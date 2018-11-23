<?php
$area=$_GET['area'];
$redis=new Redis;
$redis->connect("127.0.0.1",6379);
if($redis->exists($area)){
	$str=$redis->get($area);
	echo $str;
}
else{
	
	$key="046d0a349f1b41bd92ebb048305978f2";
	$url="https://free-api.heweather.com/s6/weather/forecast?location=$area&key=$key";
	$str=curlget($url);
	$data=json_decode($str,true);

	$data=$data['HeWeather6'][0]['daily_forecast'];
	// echo "<pre>";
	// print_r($data);
	$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
	foreach ($data as $key => $val) {
		$tem_max=$val['tmp_max'];
		$tem_min=$val['tmp_min'];
		$date=$val['date'];
		$pdo->exec("insert into weather values(null,'$area','$tem_max','$tem_min','$date')");
	}
	$str=json_encode($data);
	$redis->set($area,$str);
	echo $str;
}


function curlget($url){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$str=curl_exec($ch);
	return $str;
}
?>