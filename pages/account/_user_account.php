<?PHP
$_OPTIMIZATION["title"] = "�������";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer3">

<h3>
<center>������ ����������</center>
</h3>

<div style="float:left; width:320px; background:#f5e9c1; margin-left:5px; margin-bottom:20px; padding:10px 10px 10px 10px; border-bottom:1px solid #b8a466; text-align:center;">��� �����: <b><?=$prof_data["user"]; ?></b></div>
<div style="float:right; width:320px; background:#f5e9c1; margin-right:20px; margin-bottom:20px; padding:10px 10px 10px 10px; border-bottom:1px solid #b8a466; text-align:center;">��� �������������: <b><?=$prof_data["id"]; ?></b></div>

<div style="float:left; width:320px; background:#f5e9c1; margin-left:5px; margin-bottom:20px; padding:10px 10px 10px 10px; border-bottom:1px solid #b8a466; text-align:center;">��� �����: <b><?=$prof_data["email"]; ?></b></div>
<div style="float:right; width:320px; background:#f5e9c1; margin-right:20px; margin-bottom:20px; padding:10px 10px 10px 10px; border-bottom:1px solid #b8a466; text-align:center;">���� �����������: <b><?=date("d.m.Y � H:i",$prof_data["date_reg"]); ?></b></div>

<div style="float:left; width:320px; background:#f5e9c1; margin-left:5px; margin-bottom:20px; padding:10px 10px 10px 10px; border-bottom:1px solid #b8a466; text-align:center;">���-�� ���������: <b><?=$prof_data["referals"]; ?></b></div>
<div style="float:right; width:320px; background:#f5e9c1; margin-right:20px; margin-bottom:20px; padding:10px 10px 10px 10px; border-bottom:1px solid #b8a466; text-align:center;">��� �������: <b><?=$prof_data["referer"]; ?></b></div>


<div style="float:left; width:320px; background:#f5e9c1;  margin-left:5px; padding:10px 10px 10px 10px; border-bottom:1px solid #b8a466; text-align:center;"><div style="float:left;"><img src="/img/coin.png" width="24"></div> ����� ������� �����: <b><?=sprintf("%.2f",$prof_data["insert_sum"]); ?></b></div>
<div style="float:right; width:320px; background:#f5e9c1; margin-right:20px; padding:10px 10px 10px 10px; border-bottom:1px solid #b8a466; text-align:center;"><div style="float:left;"><img src="/img/diamon.png" width="30"></div> ������ ����������: <b><?=sprintf("%.2f",$prof_data["payment_sum"]); ?></b></div>



				
</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>				
				
				
				
				
				
				
				
				
				