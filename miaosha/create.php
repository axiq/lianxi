<?php
$redis=new Redis;
$redis->connect("127.0.0.1",6379);
$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
$data=$pdo->query("select * from goods")->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $key => $val) {
	for($i=1;$i<$val['stock'];$i++){
		$redis->lpush('goods'.$val['id'],$i);
	}
}
?>