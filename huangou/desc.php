<?php
$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
$data=$pdo->query("select * from huandesc")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table>
		<tr>
			<td>id</td>
			<td>用户id</td>
			<td>商品名称</td>
			<td>商品积分</td>
		</tr>
		<?php foreach ($data as $key => $val){ ?>
			<tr>
				<td><?php echo $val['id']?></td>
				<td><?php echo $val['user_id']?></td>
				<td><?php echo $val['goods_name']?></td>
				<td><?php echo $val['jifen']?></td>
			</tr>
		<?php } ?>
	</table>
</body>
</html>