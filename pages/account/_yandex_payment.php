<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer3">
<h3><center><img src="/img/yandex.png"></center></h3>

<?PHP
$_OPTIMIZATION["title"] = "Yandex �������";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_users_a WHERE id = '$usid' LIMIT 1");
$user_dataa = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

$status_array = array( 0 => "�����������", 1 => "�������������", 2 => "��������", 3 => "���������");

# ��������� ��������!
$minPay = 11; 

?>

<?PHP
	
	function ViewPurse($purse){
		
		if( substr($purse,0,1) != "4" ) return false;
		if( !ereg("^[0-9]{12,15}$", substr($purse,1)) ) return false;	
		return $purse;
	}
	
	
	# ������� �������
	if(isset($_POST["purse"])){
		
		$purse = ViewPurse($_POST["purse"]);
		$sum = intval($_POST["sum"]);
		$val = "RUB";
		
		if($purse !== false){
			
				if($sum >= $minPay){
				
					if($sum <= $user_data["money_p"]){
						
						# ��������� �� ������������ ������
						$db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND (status = '0' OR status = '1')");
						if($db->FetchRow() == 0){
								
								
							### ������ ������� ###	
							$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
							if ($payeer->isAuth())
							{
								
								$arBalance = $payeer->getBalance();
								if($arBalance["auth_error"] == 0)
								{
									
									
									
									$balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
									
									if( ($balance) >= ($sum_pay)){
									
									$sum_pay = round( ($sum / $sonfig_site["ser_per_wmr"]), 2);
									$sum_com = $sum_pay - ($sum_pay * 0.034);
									
									
									$initOutput = $payeer->initOutput(array(
		                            // id ��������� ������� ���������� �� ������ ��������� ������ 
		                            'ps' => '57378077',
		                            // ����, � �������� ����� ������� ��������          
		                            'curIn' => 'RUB',
		                            // ����� ������ 
		                            'sumOut' => $sum_com,
		                            // ������ ������  
		                            'curOut' => 'RUB',
		                            // ������� ���������� �������  
		                            'param_ACCOUNT_NUMBER' => $purse,
	                            ));
 								if ($initOutput)
	{
		                            // ����� ������� 
		                            $historyId = $payeer->output();
		                            if ($historyId)
		                            {
			                            echo "";
										# ������� � ������������
											$db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");
											
											# ��������� ������ � �������
											$da = time();
											$dd = $da + 60*60*24*15;
											
											$ppid = $historyId;
										
											$db->Query("INSERT INTO db_payment (user, user_id, purse, sum, valuta, serebro, payment_id, date_add, status) 
											VALUES ('$usname','$usid','$purse','$sum_pay','RUB', '$sum','$ppid','".time()."', '3')");

										
											
											
											
											$db->Query("UPDATE db_users_b SET payment_sum = payment_sum + '$sum_pay' WHERE id = '$usid'");
											$db->Query("UPDATE db_stats SET all_payments = all_payments + '$sum_pay' WHERE id = '1'");
		                            }
		                            else
		                            {
			                            ?>
			                            <div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
				���������� �������� ������� ����� ��������� �����.
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
		                        else
		                        {	                        
			                        ?>
			                            <div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>������</h4>
				���������� �������� ������� ����� ��������� �����.
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
								
	

									
										if (!empty($arTransfer["historyId"]))
										{	
										
										
											
											
											
											
											
											
											?>
			                            <div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h5>�������!</h5>
				�� �������� ������� �� ��� ���� Yandex
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
										else
										{
										
											?>
			                            <div id="parent_popup">
				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h5>�������!</h5>
				�� �������� ������� �� ��� ���� Yandex
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
				���������� �������� ������� ����� ��������� �����.
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
				���������� �������� ������� ����� ��������� �����.
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
				���������� �������� ������� ����� ��������� �����.
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
				���������� �������� ������� ����� ��������� �����.
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
				�� ������� ����� ���������� ������ ��� ������� � ��� �� �����.
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
				����������� ����� ��� ������� ���������� 12 ����������.
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
				Yandex ������� ������ ���� ������� 410000000000000. 
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

<?PHP
# �������� �� ����������
if($user_data["insert_sum"] <= 49.99){

?>

<center><h3>��� ����, ��� �� �������� �������� <br> ���������� ��������� ������ ������� �� <font color="#3e7019">50 ������</font>.</h3></center>

</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>
<?PHP

return;
}

?>




<form action="" method="post">


<table border="0" align="center">
  <tbody><tr>
    <td align="right">������� Yandex: </td>
	<td align="right"><input type="text" name="purse" class="box" placeholder="410000000000000" style="margin:0px; height:40px; width:170px;" size="15"></td>
  </tr>
  <tr>
    <td align="right">C���� <img src="/img/diamon.png" width="30">: </td>
	<td align="right"><input type="text" class="box" name="sum" id="sum" value="1" size="15" style="margin:0px; height:40px; width:170px;" onkeyup="PaymentSum();"></td>
  </tr>

  <tr>
    <td colspan="2" height="100" align="center"><input type="submit" name="swap" value="�������� �������" class="button"></td>
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