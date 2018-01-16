<style>


.ttb td {
background: #33A049;
color: #FFFFFF;
border: 1px solid #33A049;
}
.ltb {
background: #E1FFC4;
border-bottom: 1px solid #33A049;
}
.ltb td {
border: 1px solid #33A049;
}
</style>
<?PHP
######################################
#Плагин Список онлайна
#Автор INVEST-CMS.NET
######################################
$_OPTIMIZATION["title"] = "Пользователи онлайн";
$_OPTIMIZATION["description"] = "Список онлайна";
$_OPTIMIZATION["keywords"] = "Список онлайна";
# Для плагина ниже данные =\
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
# если не админ то тех. сообщение
?>
<div class="s-bk-lf">
	<div class="acc-title">Пользователи онлайн</div>
</div>
<div class="silver-bk"><div class="clr"></div>	


<BR />

<?PHP
$db->Query("SELECT * FROM db_users_a WHERE time_online > ".time()." ORDER by time_online DESC");
$colsp=$db->NumRows();
if($colsp>0){
?>


<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Логин</b></td>
	<td><b>Страница</b></td>
	<td><b>Страна</b></td>
	<td><b>Был</b></td>
</tr>
<?PHP
while($arr=$db->FetchArray()){
?>
<tr align="center" class="ltb">
		<td><?=$arr["user"]; ?></td>
		<td><?=$arr["wheres"]; ?></td>
		<td><?if($arr['user']=='admin'){ ?>RU<?}else{ echo $arr['country'];}?></td>
                <td><?PHP
$timek=round((time()+5*60-$arr['time_online'])/60,0);
if($timek==0){echo '<font color ="green">Онлайн</font>'; }else{ echo $timek.'<font color ="red"> мин. назад</font>'; }
?></td>
	</tr>
	<?PHP
	}
?>
</tbody></table>
<br>
<center>
Всего <?=$colsp;?> пользователей сейчас онлайн на данном проекте.</td></center>
<?PHP
}else{
?>
<? }
#
?>
</div>



  <!--script LANGUAGE="JavaScript1.1">
document.oncontextmenu = function(){return false;};
</script--> 


