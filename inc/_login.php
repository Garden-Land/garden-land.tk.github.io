<br>
<html lang="ru">
<head>
 <meta charset="UTF-8">
<title>Демо: Всплывающее окно при загрузке сайта с помощью CSS3 и немного javascript</title>
<style>
/* Всплывающее окно */	
#parent_popup {
  background-color: rgba(0, 0, 0, 0.8);
  display: none;
  position: fixed;
  z-index: 99999;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}
#popup { 
  background: #fff;
    max-width: 520px;
    width: 100%;
    margin: 10% auto;
	padding: 5px 20px 13px 20px;
	border: 10px solid #ddd;
	position: relative;
	/*--CSS3 CSS3 Тени для Блока--*/
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
	/*--CSS3 Закругленные углы--*/
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
#popup h1{
    font:28px Monotype Corsiva, Arial;
    font-weight: bold;
	text-align: center;
	color: #008000;
	text-shadow: 0 1px 3px rgba(0,0,0,.3);
	}
#popup h2{
    font:24px Monotype Corsiva, Arial;      
	color: #008000;
	text-align: left;
	text-shadow: 0 1px 3px rgba(0,0,0,.3);
	}
/* кнопка закрытия */
.close {
    background-color: rgba(0, 0, 0, 0.8);
	border: 2px solid #ccc;
    height: 24px;
    line-height: 24px;
    position: absolute;
    right: -24px;
	cursor: pointer;
    text-align: center;
    text-decoration: none;
	color: rgba(255, 255, 255, 0.9);
    font-size: 14px;
    font-family: helvetica, arial;
    text-shadow: 0 -1px rgba(0, 0, 0, 0.9);
    top: -24px;
    width: 24px;
	-webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    -ms-border-radius: 15px;
    -o-border-radius: 15px;
    border-radius: 15px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
}
.close:hover {
    background-color: rgba(255, 69, 0, 0.8);
}
</style>

</body>
</html>

<?PHP

	if(isset($_POST["log_email"])){
	
	$lmail = $func->IsMail($_POST["log_email"]);
	
		if($lmail !== false){
		
			$db->Query("SELECT id, user, pass, referer_id, banned FROM db_users_a WHERE email = '$lmail'");
			if($db->NumRows() == 1){
			
			$log_data = $db->FetchArray();
			
				if(strtolower($log_data["pass"]) == strtolower($_POST["pass"])){
				
					if($log_data["banned"] == 0){
						
						# Считаем рефералов
						$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$log_data["id"]."'");
						$refs = $db->FetchRow();
						
						$db->Query("UPDATE db_users_a SET referals = '$refs', date_login = '".time()."', ip = INET_ATON('".$func->UserIP."') WHERE id = '".$log_data["id"]."'");
						
						$_SESSION["user_id"] = $log_data["id"];
						$_SESSION["user"] = $log_data["user"];
						$_SESSION["referer_id"] = $log_data["referer_id"];
						Header("Location: /profile.html");
						
					}else 
						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<h1>«В доступе отказано»</h1>

				Ваш аккаунт заблокирован

				</br>
				<h2>Для восстановления доступа, обратитесь в тех. поддержку</h2>

				<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

						}
				}else 
					{
?>
				<div id="parent_popup">
				  <div id="popup">
				<h1>«В доступе отказано»</h1>

				Не верные данные
				</br>
				Исправьте ошибку и повторите ввод 
				</br>
				<h2>Если возникают трудности, обратитесь в тех. поддержку</h2>

				<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

				}
			}else
				{


?>
				<div id="parent_popup">
				  <div id="popup">
				<h1>«В доступе отказано»</h1>

				Указанный E-mail не зарегистрирован в системе
				</br>
				<a class="button" href="../signup.html">Зарегистрируйесь </a> или исправьте ошибку и повторите ввод 
				</br>
				<h2>Если возникают трудности, обратитесь в тех. поддержку</h2>

				<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

				}
		}else {
					?>
				<div id="parent_popup">
				  <div id="popup">
				<h1>«В доступе отказано»</h1>

				Не корректно введен E-Mail
				</br>
				Исправьте ошибку и повторите ввод 
				</br>
				<h2>Если возникают трудности, обратитесь в тех. поддержку</h2>

				<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?
			}
	
	}

?>
<div class="nonvis">
	<div class="sliderplace" align="center">
	</div>
</div>

<div class="loginline"><div class="loginlinein">
<div class="autoriz">
	<form action="" method="post">
	
<table border="0" style="vertical-align:middle; width: 100%; height: 100%;" align="left">
  <tbody><tr>
	<td style="width: 210px;"><font style="color: #7f8c8d;"></font>&nbsp;&nbsp;<input name="log_email" placeholder="E-mail" type="text" maxlength="35" class="lg"></td>
	<td style="width: 220px;"><font style="color: #7f8c8d;"></font>&nbsp;&nbsp;<input name="pass" placeholder="Пароль" type="password" maxlength="35" class="ps"></td>
    <td><input type="submit" value="Войти" class="btn_in"></form></td>
	<td style="width: 130px;" align="center"><a href="/recovery.html" class="rs-ps">Забыли пароль?</a></td>


<td align="right"><form action="/signup.html" method="post">
    <input type="submit" value="Регистрация" class="btn_reg"></form></td>
  </tr>
  
</tbody></table>

</div></div></div>