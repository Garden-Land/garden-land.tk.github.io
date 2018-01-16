<h2>Авторизация</h2>

<?PHP
if(isset($_SESSION["admin"])){ Header("Location: /?menu=gardener"); return; }

if(isset($_POST["admlogin"])){

	$db->Query("SELECT * FROM db_config WHERE id = 1 LIMIT 1");
	$data_log = $db->FetchArray();
	
	if(strtolower($_POST["admlogin"]) == strtolower($data_log["admin"]) AND strtolower($_POST["admpass"]) == strtolower($data_log["pass"]) ){
	
		$_SESSION["admin"] = true;
		Header("Location: /?menu=gardener");
		return;
	}else echo "<center><font color = 'red'><b>Неверно введен логин и/или пароль</b></font></center><BR />";
	
}

?>
<form action="" method="post">
<table width="300" border="0" align="center">
  <tr>
    <td><b>Логин:</b></td>
	<td align="center"><input type="text" name="admlogin" value="" /></td>
  </tr>
  <tr>
    <td><b>Пароль:</b></td>
	<td align="center"><input type="password" name="admpass" value="" /></td>
  </tr>
  <tr>
	<td style="padding-top:5px;" align="center" colspan="2"><input type="submit" value="Войти" /></td>
  </tr>
</table>
</form>