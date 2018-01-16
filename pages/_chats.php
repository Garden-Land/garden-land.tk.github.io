                                                                <?PHP
$_OPTIMIZATION["title"] = "Чат";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
$dadd = time();
?>
<div class="s-bk-lf">
	<div class="acc-title">Чат</div>
</div>
<div class="silver-bk">
<h2><center>Правила:</center></h2>

<center>1. Запрещено использовать нецензурные выражения и спам.</center>

<center>2. Запрещено оставлять ссылки на другие сайты/проекты.      </center>

<center>3. Запрещено оставлять провокационные комментарии. </center>
<center><p style="font-size: 20px;color:#9E0404; font-weight: bold;">Просим вас строго соблюдать правила!!!</p></center>


<table cellpadding='3' cellspacing='0' border='0'  align='center' width="550" BGCOLOR="#f7f7f7" >
 <center><?PHP if($user_data["money_b"] >-1) {?><form action="" method="post">
<b>Сообщение:</b><BR />
<textarea  name="ntext" cols="50" rows="3"><?=(isset($_POST["ntext"])) ? $_POST["ntext"] : false; ?></textarea><BR />
<center><input type="submit" name="chat" value="Отправить" style="height:30px;" /></center>
</form><font color="blue"><b></b></font></a> <?PHP } else {	?> Для отправки сообщений на вашем счету должно быть серебро (Отправка бесплатная!)<?PHP } ?></center>
  <?PHP

  $db->Query("SELECT * FROM db_news ORDER BY id DESC LIMIT 10");

	if($db->NumRows() > 0){

  		while($bon = $db->FetchArray()){

		?>
		<tr>
		<td colspan="2"><HR SIZE="2" WIDTH="90%" ALIGN="center" COLOR="#fc6104"></td></tr><tr>
    		<td align="left" width="300">

			<font color=blue>
			<b><?=$bon["user"]; ?></b></font></td><td align="right" width="200"><font color=blue><?=date("d.m.Y",$bon["date_add"]); ?></td></tr><tr>
    		<td colspan="2" align="left"><? if ($bon["id"]=="1") # если ник пользователя в чате админ- то его сообщения имеют следующий цвет:
			{?><font color=red> <? } ?>  <?=$bon["tekst"]; ?></td>

		</tr>
		<?PHP

		}

	}else echo '<tr><td align="center" colspan="3">Нет записей</td></tr>'
  ?>

  <tr>
    <td colspan="2" align="center"><h4><font color="red">Показаны последние 10 сообщений</font></h4></td>
    </tr>
</table>
<?PHP

if(isset($_POST["chat"])) {

$text =$_POST["ntext"];
if($user_data["money_b"] < -1) # проверяем наличие денег


{
if (preg_match("/[\>|\<]/",$text)) # запрещаем символы < и >
{ echo "<center><b><font color = 'red'>Сообщение содержит запрещенные символы</font></b></center><BR />";
} else {

            $db->Query("INSERT INTO db_news (user, tekst, date_add) VALUES ('$uname','$text','$dadd')");
			$db->Query("UPDATE db_users_b SET money_b = money_b - 0 WHERE id = '$usid'");
			echo "<center><b><font color = 'blue'>Сообщение отправлено</font></b></center><BR />";

?>
<script type="text/javascript">
				location.replace("/chat");
				</script>
				<noscript>
				<meta http-equiv="refresh" content="0; url=/chat">
				</noscript>
<?



}
} else echo "<center><b><font color = 'red'>Недостаточно серебра для общения</font></b></center><BR />";
}
?>

<center style=" letter-spacing: 3px; font-size: 20px; padding: 20px; text-shadow: 0 1px 0 #fff,1px 2px 2px #aaa; ">



                            
                            