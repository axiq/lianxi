<?php
$pdo=new PDO("mysql:host=127.0.0.1;dbname=07a","root","root");
$data=$pdo->query("select * from goods")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php foreach ($data as $key => $val): ?>
	<div style="float:left;margin-right:20px">
		<p>
			<span id="h<?php echo $val['id']?>"></span> 时
			<span id="m<?php echo $val['id']?>"></span> 分
			<span id="s<?php echo $val['id']?>"></span> 秒
		</p>
		<p><img src="<?php echo $val['img']?>" alt="" width='270' height='330'></p>
		<p><?php echo $val['name']?></p>
		<p><?php echo $val['price']?></p>
		<p><input type="button" value="抢购" id="<?php echo $val['id']?>"></p>
	</div>
<?php endforeach ?>
	
</body>
</html>
<script src="jquery-2.1.4.min.js"></script>
<script>
	$(document).on("ready",function(){
		setInterval(function(){
			$.ajax({
				url:'calctime.php',
				type:'get',
				dataType:'json',
				success:function(e){
					for(var i=0;i<e.length;i++){
						id=e[i]['id'];
						$("#h"+id).text(e[i]['hour']);
						$("#m"+id).text(e[i]['minute']);
						$("#s"+id).text(e[i]['second']);
					}
				}
			})
		},1000);
		$("input[type=button]").click(function(){
			var id=$(this).attr('id');
			$.ajax({
				url:'miaosha.php',
				type:'get',
				dataType:'json',
				data:{id:id},
				success:function(e){
					if(e['code']==1){
						alert(e['msg']);
					}
					else{
						alert(e['msg']);
					}
				}
			})
		})
	})

</script>