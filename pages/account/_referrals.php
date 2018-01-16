<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer2">
<h3>
<center>Мои рефералы</center>
</h3>

<?PHP
$_OPTIMIZATION["title"] = "Рефералы";
$user_id = $_SESSION["user_id"];
$uname = $_SESSION["user"];
$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '$user_id'");
$refs = $db->FetchRow();
$refdate=time() - 60*60*24;
$db->Query("SELECT COUNT(*) FROM tb_posetitel WHERE referer_id = '$user_id' and datein>'$refdate'");
$refnadatu = $db->FetchRow();
?>


<script type="text/javascript"
src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

  <style type="text/css">
 .spoiler_body { display:none; font-style:italic; }
 .spoiler_links { 
width:250px;
background-color:#703d0e;
padding:10px 15px 10px 15px;
cursor: pointer;
border-radius:6px;
color:#fff;
font-size:22px;
border:1px solid #552d08;
} 
</style>
<script type="text/javascript">
$(document).ready(function(){
 $('.spoiler_links').click(function(){
  $(this).next('.spoiler_body').toggle('normal');
  return false;
 });
});
</script>
<center>
<input type="submit" value="Банеры" class="spoiler_links blue">
<div class="spoiler_body">
<br>
<div align="center">
<br>
<br>
	<img src="/baner/468x60.gif">
	</a> <br>
        <center> Баннер 468х60 </center>
<center><td align="left"><input onclick="this.select()" readonly="" style="width:370px; padding:10px 10px 10px 10px; border-radius:8px; border:none;" value="https://garden-land.online/baner/468x60.gif"></td></center>
	<br>
<br>
	<img src="/baner/200x300.gif">
	</a> <br>
        <center> Баннер 200х300 </center>
<center><td align="left"><input onclick="this.select()" readonly="" style="width:370px; padding:10px 10px 10px 10px; border-radius:8px; border:none;" value="https://garden-land.online/baner/200x300.gif"></td></center>
	<br>
</div>
</div>
</center>
<br> 
<center>Ссылка для привлечения рефералов:<br> <td align="left"><input onclick="this.select()" readonly="" style="width:370px; padding:10px 10px 10px 10px; border-radius:8px; border:none;" value="https://garden-land.online/?ref=<?=$_SESSION["user_id"]; ?>"></td></center>
<center>Всего рефералов: <font color="#000;"><?=$refs; ?> чел.</font></center></br>


<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>Логин</b></td>
	<td><b>Доход</b></td>
	<td><b>Почта</b></td>
	<td><b>Дата</b></td>
</tr>
<?PHP
  $all_money = 0;
  $db->Query("SELECT db_users_a.user, db_users_a.date_reg, db_users_a.email, db_users_b.to_referer FROM db_users_a, db_users_b 
  WHERE db_users_a.id = db_users_b.id AND db_users_a.referer_id = '$user_id' ORDER BY to_referer DESC");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		
		?>
<tr align="center" class="ltb">
		<td><?=$ref["user"]; ?></td>
		<td><?=sprintf("%.2f",$ref["to_referer"]); ?> руб.</td>
		<td><?=$ref["email"]; ?></td>
		<td><?=date("d.m (H:i)",$ref["date_reg"]); ?></td>
	</tr>
		<?PHP
		$all_money += $ref["to_referer"];
		}
  
	}else echo '<tr><td align="center" colspan="4">У вас нет рефералов</td></tr>'
  ?>
</tbody></table>


</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>