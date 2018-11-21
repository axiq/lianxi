<?php
session_start();
$id=$_SESSION['id'];
$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
$data=$pdo->query("select * from good")->fetchAll(PDO::FETCH_ASSOC);
$user=$pdo->query("select integral from yonghu where id=$id")->fetch(PDO::FETCH_ASSOC);
$integral=$user['integral'];
// echo "<pre>";
// print_r($user);
$d=$pdo->query("select * from huandesc")->fetchAll(PDO::FETCH_ASSOC);
$arrResult=[];
foreach ($d as $key => $value) {
	$arrResult[]=$value['user_id'].$value['goods_id'];
}
// echo "<pre>";
// print_r($arrResult);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php foreach ($data as $key => $val){ ?>
		<div style="float:left;margin-right:20px">
			<p><img src="<?php echo $val['img']?>" alt=""></p>
			<p><?php echo $val['name']?></p>
			<?php if (in_array($id.$val['id'], $arrResult)){ ?>
				<p><input type="button" value="已换购"></p>
			<?php }else{ ?>
			<p><input type="button" value="换购" id="huan<?php echo $val['id']?>" onclick="huangou(<?php echo $val['id']?>,<?php echo $val['jifen']?>)"></p>
			<?php }?>
		</div>
	<?php } ?>
</body>
</html>
<script src="jquery-2.1.4.min.js"></script>
<script>
	function huangou(goods_id,jifen){
		var integral="<?php echo $integral?>";
		console.log(integral)
		if(!confirm('当前商品需要积分'+jifen)){
			return false;
		}
		
		if(integral<jifen){
			alert('您的积分不足');
			return false;
		}
		$.ajax({
			url:'huangou.php?goods_id='+goods_id+'&jifen='+jifen,
			type:'get',
			dataType:'text',
			success:function(e){
				if(e=='ok'){
					alert('换购成功');
					$("#huan"+goods_id).attr("value",'已换购');
				}
			}
		})
	}
</script>