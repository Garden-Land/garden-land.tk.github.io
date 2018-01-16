
<?PHP
$_OPTIMIZATION["title"] = "Статистика";
$_OPTIMIZATION["description"] = "Статистика";
$_OPTIMIZATION["keywords"] = "Статистика";
?>
<div class="content">
<div class="content-panel">

<h3>
<center>Статистика проекта</center>
</h3>
<div class="layer">
<div class="question"><b>ПОСЛЕДНИЕ 10 ВЫПЛАТ</b></div>
<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Логин</b></td>
	<td><b>Сумма</b></td>
	<td><b>Почта</b></td>
	<td><b>Дата выплаты</b></td>
</tr>
<?PHP

$all_pay_sum=0;
$dt = time() - 60*60*48;
$db->Query("SELECT * FROM db_payment, db_users_a  WHERE db_payment.status = '3' AND db_users_a.user = db_payment.user ORDER BY db_payment.date_add DESC LIMIT 10 ");
	while($data1 = $db->FetchArray()){
	
	$all_pay_sum += $data1["serebro"]/100;
		
	?>
<tr align="center" class="ltb">
		<td><?=$data1["user"]; ?></td>
		<td><?=sprintf("%.2f",$data1["sum"]); ?>  руб.</td>
		<td><?=str_replace(substr($data1["email"],2,3), '<font color="red">***</font>', $data1["email"]); ?></td>
		<td><?=date("d.m.Y H:i",$data1["date_add"]); ?></td>
	</tr>
	<?PHP
	}
?>
</tbody></table>

<div class="space2"></div>


<div class="question"><b>ПОСЛЕДНИЕ 10 ПОПОЛНЕНИЙ</b></div>
<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Логин</b></td>
	<td><b>Сумма</b></td>
	<td><b>Почта</b></td>
	<td><b>Дата пополнения</b></td>
</tr>
<?PHP	
$db->Query("SELECT * FROM db_insert_money, db_users_a  WHERE  db_users_a.user = db_insert_money.user ORDER BY db_insert_money.date_add DESC LIMIT 10 ");
	while($data2 = $db->FetchArray()){
?>
<tr align="center" class="ltb">
		<td><?=$data2["user"]; ?></td>
		<td><?=sprintf("%.2f",$data2["money"]); ?> руб.</td>
		<td><?=str_replace(substr($data2["email"],2,3), '<font color="red">***</font>', $data2["email"]); ?></td>
		<td><?=date("d.m.Y H:i",$data2["date_add"]); ?></td>
	</tr>
	<?PHP
	}
?>
</tbody></table>

<div class="space2"></div>

<div class="question"><b>ПОСЛЕДНИЕ 10 РЕГИСТРАЦИЙ</b></div>
<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Логин</b></td>
	<td><b>Пригласил</b></td>
	<td><b>Почта</b></td>
	<td><b>Дата регистрации</b></td>
</tr>
	<?PHP
$db->Query("SELECT * FROM db_users_a ORDER BY date_reg DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
?>
<tr align="center" class="ltb">
		<td><?=$data["user"]; ?></td>
		<td><?=$data["referer"]; ?></td>
		<td><?=str_replace(substr($data["email"],2,3), '<font color="red">***</font>', $data["email"]); ?></td>
		<td><?=date("d.m.Y H:i",$data["date_reg"]); ?></td>
	</tr>
	<?PHP
	}
?>
</tbody></table>

<div class="space2"></div>

<div class="question"><b>ТОП 10 ВЫПЛАТ</b></div>
<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Логин</b></td>
	<td><b>Сумма</b></td>
	<td><b>Почта</b></td>
	<td><b>Дата регистрации</b></td>
</tr>

<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY db_users_b.payment_sum DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
<tr align="center" class="ltb">
		<td><?=$data["user"]; ?></td>
		<td><?=sprintf("%.2f",$data["payment_sum"]); ?> руб.</td>
		<td><?=str_replace(substr($data["email"],2,3), '<font color="red">***</font>', $data["email"]); ?></td>
		<td><?=date("d.m.Y H:i",$data["date_reg"]); ?></td>
	</tr>
	<?PHP
	}
?>
</tbody></table>

<div class="space2"></div>


<div class="question"><b>ТОП 10 ПОПОЛНЕНИЙ</b></div>
<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Логин</b></td>
	<td><b>Сумма</b></td>
	<td><b>Почта</b></td>
	<td><b>Дата регистрации</b></td>
</tr>

<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY db_users_b.insert_sum DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
<tr align="center" class="ltb">
		<td><?=$data["user"]; ?></td>
		<td><?=sprintf("%.2f",$data["insert_sum"]); ?> руб.</td>
		<td><?=str_replace(substr($data["email"],2,3), '<font color="red">***</font>', $data["email"]); ?></td>
		<td><?=date("d.m.Y H:i",$data["date_reg"]); ?></td>
	</tr>
	<?PHP
	}
?>
</tbody></table>

<div class="space2"></div>

<div class="question"><b>ТОП 10 РЕФЕРАЛОВ</b></div>
<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Логин</b></td>
	<td><b>Кол-во рефералов</b></td>
	<td><b>Почта</b></td>
	<td><b>Дата регистрации</b></td>
</tr>


<?php
	$db->Query("SELECT * FROM `db_users_a` ORDER BY referals DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
<tr align="center" class="ltb">
		<td><?=$data["user"]; ?></td>
		<td><?=$data["referals"]; ?> чел.</td>
		<td><?=str_replace(substr($data["email"],2,3), '<font color="red">***</font>', $data["email"]); ?></td>
		<td><?=date("d.m.Y H:i",$data["date_reg"]); ?></td>
	</tr>
	<?PHP
	}
?>
</tbody></table>

</div>
</div>
</div>
<div class="clr"></div>
<?PHP include("inc/_intro.php"); ?>