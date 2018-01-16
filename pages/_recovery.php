<style>
.blue-button {
font-size: 14pt;
color: #FFFFFF;
background: #3498db;
border: none;
border-radius: 6px;
width: 200px;
height: 50px;
cursor: pointer;
margin: 45px 0px -17px 0px;
}
</style>
<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Восстановление пароля";
$_OPTIMIZATION["description"] = "Восстановление забытого пароля";
$_OPTIMIZATION["keywords"] = "Восстановление забытого пароля";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }

?>
<div class="s-bk-lf">
	<div class="acc-title">Восстановление пароля</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP

	if(isset($_POST["email"])){

		if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
		
		unset($_SESSION["captcha"]);
		
		$email = $func->IsMail($_POST["email"]);
		$time = time();
		$tdel = $time + 60*15;
		
			if($email !== false){
				
				$db->Query("DELETE FROM db_recovery WHERE date_del < '$time'");
				$db->Query("SELECT COUNT(*) FROM db_recovery WHERE ip = INET_ATON('".$func->UserIP."') OR email = '$email'");
				if($db->FetchRow() == 0){
				
					$db->Query("SELECT id, user, email, pass FROM db_users_a WHERE email = '$email'");
					if($db->NumRows() == 1){
					$db_q = $db->FetchArray();
					
					# Вносим запись в БД
					$db->Query("INSERT INTO db_recovery (email, ip, date_add, date_del) VALUES ('$email',INET_ATON('".$func->UserIP."'),'$time','$tdel')");
					
					# Отправляем пароль
					$sender = new isender;
					$sender -> RecoveryPassword($db_q["email"], $db_q["pass"], $db_q["email"]);
					
					echo "<center><div class='success'>Данные отправлены на ваш E-mail</div></center>";
					?>
					</div>
					<div class="clr"></div>	
					<?PHP
					return; 
					
					}else echo "<center><div class='error'>Пользователь с таким E-mail не зарегистрирован</div></center>";
				
				}else echo "<center><div class='error'>На Ваш E-mail или IP уже был отправлен пароль за последние 15 минут</div></center>";
				
			}else echo "<center><div class='error'>Недопустимый формат E-mail</div></center>";
		
		}else echo "<center><div class='error'>Защитный код введен неверно</div></center>";
	
	}

?>

<BR />
<form action="" method="post">
<table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody><tr>
	<td align="center" class="reg-text">Ваш E-Mail </td>
</tr>
<tr>
	<td align="center"><input name="email" type="text" class="reg-input" maxlength="50" value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>"/></td>
</tr>
<tr>
	<td height="20"></td>
</tr>
<tr>
	<td align="center" class="reg-text">Защитный код</td>
</tr>
<tr>
	<td align="left" width="250" style="padding-top:20px;">
<img src="/captcha.php?rnd=<?=rand(1,10000); ?>" id="captcha_img" style="position:absolute;margin-left:219px;margin-top:-18px;border:1px solid #BDC3C7;border-radius:0 0px 0px 0;">
</td>			

</tr>
<tr>
	<td align="center"><input name="captcha" type="text" class="reg-captcha" maxlength="50" style="position:absolute;margin-left:-123px;margin-top:-18px;border:1px solid #BDC3C7;border-radius:0 0px 0px 0;"></td>
</tr>
<tr>
	<td align="center"><br><input type="submit" value="Восстановить" class="blue-button"></td>
</tr>
</tbody></table>


</div>
<div class="clr"></div>	