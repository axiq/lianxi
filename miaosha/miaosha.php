<?php
$id=$_GET['id'];
$redis=new Redis;
$redis->connect("127.0.0.1",6379);
$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
$key='goods'.$id;
if($redis->llen($key)>0){
	$redis->lpop($key);
	$res=$pdo->exec("update goods set stock=stock-1 where id=$id");
	$order_id=date('Y-m-d',time()).md5(rand(100,999));
	$addtime=time();
	$sql="insert into order values(null,'$order_id',$id,$addtime)";
	echo $sql;
	if($res){
		$pdo->exec($sql);
		echo json_encode(['code'=>1,'msg'=>'秒杀成功']);
	}
}
else{
	echo json_encode(['code'=>0,'msg'=>'秒杀结束']);
}
?>