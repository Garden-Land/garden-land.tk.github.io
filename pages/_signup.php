
<?PHP
$_OPTIMIZATION["title"] = "����������� ������ ������������";
$_OPTIMIZATION["description"] = "����������� ������������ � �������";
$_OPTIMIZATION["keywords"] = "����������� ������ ��������� � �������";

if(isset($_SESSION["user_id"])){ Header("Location: /my-farm"); return; }
?>

<div class="content">
<div class="content-panel">
<h3>
<center>����������� ������ ������������</center>
</h3>
<?PHP
	
	# ����������

	if(isset($_POST["login"])){
	

	$login = $func->IsLogin($_POST["login"]);
	$pass = $func->IsPassword($_POST["pass"]);
	$rules = isset($_POST["rules"]) ? true : false;
	$time = time();
	$ip = $func->UserIP;
	$ipregs = $db->Query("SELECT * FROM `db_users_a` WHERE INET_NTOA(db_users_a.ip) = '$ip' ");
	$ipregs = $db->NumRows();

	$email = $func->IsMail($_POST["email"]);
	$referer_id = (isset($_COOKIE["i"]) AND intval($_COOKIE["i"]) > 0 AND intval($_COOKIE["i"]) < 1000000) ? intval($_COOKIE["i"]) : 1;
	$referer_name = "";
	if($referer_id != 1){
		$db->Query("SELECT user FROM db_users_a WHERE id = '$referer_id' LIMIT 1");
		if($db->NumRows() > 0){$referer_name = $db->FetchRow();}
		else{ $referer_id = 1; $referer_name = "admin"; }
	}else{ $referer_id = 1; $referer_name = "admin"; }
	
		if($rules){
			if($ipregs == 0) {

			if($email !== false){
		
			if($login !== false){
			
				if($pass !== false){
			
					if($pass == $_POST["repass"]){
						
						$db->Query("SELECT COUNT(*) FROM db_users_a WHERE user = '$login'");
						if($db->FetchRow() == 0){
						
						# ������ �����������
						$db->Query("INSERT INTO db_users_a (user, email, pass, referer, referer_id, date_reg, ip) 
						VALUES ('$login','{$email}','$pass','$referer_name','$referer_id','$time',INET_ATON('$ip'))");
						
						$lid = $db->LastInsert();
						
						$db->Query("INSERT INTO db_users_b (id, user, money_b, a_t, last_sbor) VALUES ('$lid','$login','150','0', '".time()."')");
						
						# �������� ����������
						$db->Query("UPDATE db_stats SET all_users = all_users +1 WHERE id = '1'");
						$db->Query("UPDATE db_users_b SET money_b = money_b +1 WHERE id = '$referer_id'");
						
						echo "<center><font color='#608623;'>����������� ������ �������.</font><br> �� ��� ���� ��� ������� �������� ����� � ������� 150 ������� �����.</center>";
						?>	
</div>
</div>
<div class="clr"></div>
<?PHP include("inc/_intro.php"); ?>
				
						<?PHP
						return;
						}else    						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                ������ ����� ��� ������������ � ����. 
                </div>
				

				<a class="close" title="�������" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

						}
						
					}else    						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                ������ � ������ ������ �� ���������. 
                </div>

				<a class="close" title="�������" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

						}
			
				}else   						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                ����������� ��������� ���� ������. 
                </div>
				

				<a class="close" title="�������" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

						}
			
			}else   						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                ����������� ��������� ���� �����. 
                </div>
				

				<a class="close" title="�������" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

						}

		}else  						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                ������ ����� ����� �������� ������. 
                </div>

				<a class="close" title="�������" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

						}
		
		}else 						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                � ���� ��������� ��������� �����������. 
                </div>
				

				<a class="close" title="�������" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
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
				
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                �� �� ����������� ������� �����������. 
                </div>
			    <a class="close" title="�������" onclick="document.getElementById('parent_popup').style.display='none';"><b>X</b></a>
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



<form action="" method="post">
<div class="content-left2">
<input name="login" class="box" type="text" placeholder="�����" size="25" maxlength="10" value="<?=(isset($_POST["login"])) ? $_POST["login"] : false; ?>"/>
<div class="clr"></div>
����� ������������ ��� ����� � ������ �������.
<div class="space2"></div>
<input name="email" class="box" placeholder="���� �����" type="text" size="25" maxlength="50" value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>"/>
<div class="clr"></div>
����� ���������� ��� �����, � ��� �� �������������� ���������� ������.
<div class="space2"></div>
 </div> 
  </table>
  <div class="content-right2">
<input name="pass" class="box" placeholder="������" type="password" size="25" maxlength="20" />
<input name="repass" class="box" placeholder="��������� ������" type="password" size="25" maxlength="20" />
<div class="clr"></div>
<input name="rules" type="checkbox" id="checkboxG1" class="css-checkbox" /><label for="checkboxG1" class="css-label"></label> ��������(�) � �������� <a href="/rules">������� �����������.</a>
<div class="space2"></div>
<input name="registr" type="submit" class="button" value="�����������" >
</div>
</form>
</div>

</div>

<div class="clr"></div>
<?PHP include("inc/_intro.php"); ?>







