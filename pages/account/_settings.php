<?PHP
$_OPTIMIZATION["title"] = "���������";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();
?>
<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer3">
<h3>
<center>����� ������� ������</center>
</h3>
	 <?PHP
	 
	 
	if(isset($_POST["new"])){

        
		$new = $func->IsPassword($_POST["new"]);
		
			
				if($new !== false){

					if( strtolower($new) == strtolower($_POST["re_new"])){
				
					
						$db->Query("UPDATE db_users_a SET pass = '$new', name='$name' WHERE id = '$usid'");
						
						?>
			                            <div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h5>�������!</h5>
                �� ������� ���� ������ ������. 
                </div>
                

				<a class="close" title="�������" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>
				<?
					
					}else 						{
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
				
				}else {
					?>
				<div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
                ������ ������ �������� ������� �� 6-� ��������. 
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
<table  border="0" align="center">
  <tbody>

  <tr>
    <td align="center"><input type="password" placeholder="����� ������" name="new" class="box"></td>
  </tr>
  <tr>
    <td align="center"><input type="password" placeholder="��������� ������" name="re_new" class="box"></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><br><input type="submit" value="������� ������" class="button"></td>
  </tr>
</tbody></table>
</form>
</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>



