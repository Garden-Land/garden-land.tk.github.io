
<div class="content">
<div class="content-panel">

<div class="content-left">

<h3>���� � ������ �������</h3>
<div class="space2"></div>
<?PHP

$_OPTIMIZATION["title"] = "����/��������������";
$_OPTIMIZATION["description"] = "����/��������������";
$_OPTIMIZATION["keywords"] = "����/��������������";

if(isset($_SESSION["user_id"])){ Header("Location: /my-farm"); return; }

?>
<?PHP

	if(isset($_POST["log_email"])){
	
	$lmail = $_POST["log_email"];
	
		if($lmail !== false){
		
			$db->Query("SELECT id, user, pass, referer_id, banned FROM db_users_a WHERE user = '$lmail'");
			if($db->NumRows() == 1){
			
			$log_data = $db->FetchArray();
			
				if(strtolower($log_data["pass"]) == strtolower($_POST["pass"])){
				
					if($log_data["banned"] == 0){
						
						# ������� ���������
						$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$log_data["id"]."'");
						$refs = $db->FetchRow();
						
						$db->Query("UPDATE db_users_a SET referals = '$refs', date_login = '".time()."', ip = INET_ATON('".$func->UserIP."') WHERE id = '".$log_data["id"]."'");
						
						$_SESSION["user_id"] = $log_data["id"];
						$_SESSION["user"] = $log_data["user"];
						$_SESSION["referer_id"] = $log_data["referer_id"];
						Header("Location: /my-farm");
						
					}else 
						{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                ��� ������� ������������, ���������� � ��������� �� ����������� �������������. 
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
				}else 
					{
?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                ����� ��� ������ ������� �������. 
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
			}else
				{


?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                �������� ����� �� ��������������� � ����. 
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
                �� ����� ������������ �����. 
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
	
	}

?>


<form action="" method="post">
<input name="log_email" placeholder="�����" type="text" maxlength="35" class="box">
<input name="pass" placeholder="������" type="password" maxlength="35" class="box">
<input type="submit" value="�����" class="button"></form>
</div>

<div class="content-right">

<h3>�������������� ������</h3>

<?PHP

	if(isset($_POST["email"])){
		
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
					
					# ������ ������ � ��
					$db->Query("INSERT INTO db_recovery (email, ip, date_add, date_del) VALUES ('$email',INET_ATON('".$func->UserIP."'),'$time','$tdel')");
					
					# ���������� ������
					$sender = new isender;
					$sender -> RecoveryPassword($db_q["email"], $db_q["pass"], $db_q["email"]);
					
					echo "<div class='success'>��� ������ ��������� �� ����� ��������� ��� �����������.</div>";
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
                ������ ����� �� ���������������� � ����. 
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
                �� ��� ��������� ������ ��� �� �����. 
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
			}else{
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
	
	}

?>

<div style="font-size:14px; width:370px; padding:0px 0px 25px 0px;">��� �������������� ������ ������� ���� ����� ��������� ��� �����������, �� ��� ����� ������ ������ �� ������ ��������.</div>
<form action="" method="post">
<input name="email" class="box" type="text" placeholder="���� �����" maxlength="50" value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>"/>
<input type="submit" value="���������" class="button"></form>
</div>
</div>
</div>

<div class="clr"></div>
<?PHP include("inc/_intro.php"); ?>





