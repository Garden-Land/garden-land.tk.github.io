<div class="s-bk-lf">
	<div class="acc-title">������� ����������</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<center><a href = "/?gardener&sel=invcompconfig" class="stn">������� �������</a> || <a href = "/?menu=gardener&sel=invcompconfig&add" class="stn">�������� �������</a> || <a href = "/?menu=gardener&sel=invcompconfig&list" class="stn">�����������</a></center>
<BR />
<?PHP



# ���������� ��������
if(isset($_GET["add"])){


	$db->Query("SELECT * FROM db_invcompetition WHERE status = '0'");
	if($db->NumRows() > 0){
	
	echo "<center><b><font color = 'red'>�������� ����������� �������. <BR />��������� �������, ���� ������� �����</font></b></center><BR />";
	
	?>
	</div>
	<div class="clr"></div>	
	<?PHP
	
	return;
	}
	
	# �������� ��������
	if(isset($_POST["1m"])){
	
		$m1 = (intval($_POST["1m"]) > 0) ? intval($_POST["1m"]) : 0;
		$m2 = (intval($_POST["2m"]) > 0) ? intval($_POST["2m"]) : 0;
		$m3 = (intval($_POST["3m"]) > 0) ? intval($_POST["3m"]) : 0;
		$m4 = (intval($_POST["4m"]) > 0) ? intval($_POST["4m"]) : 0;
		$m5 = (intval($_POST["5m"]) > 0) ? intval($_POST["5m"]) : 0;
		$duration = time() + intval($_POST["duration"]) * 86400;
		
		if($m1 > $m2 AND $m2 > $m3 AND $m3 > $m4 AND $m4 > $m5){
		
			$db->Query("INSERT INTO db_invcompetition (1m, 2m, 3m, 4m, 5m, date_add, date_end) VALUES ('$m1','$m2','$m3','$m4','$m5','".time()."','$duration')");
			
			echo "<center><b><font color = 'green'>������� ������</font></b></center><BR />";
			
			?>			
			</div>
			<div class="clr"></div>	
			<?PHP
			
			return;
			
		}else echo "<center><b><font color = 'red'>1� ����� ������ ���� ������ �������, 2� ����� ������ �������,3� ����� ������ ����������, 4� ����� ������ ������!</font></b></center><BR />";
		
	}
	
?>
<form action="" method="post">
<table width="300" border="0" align="center">
  <tr >
    <td>����������������� (����):</td>
    <td align="center">
	<select name="duration">
		
		<?PHP
		$count = 0;
		while( $count <= 365 ){
		$count++;
		?>
		<option value="<?=$count; ?>">&nbsp;&nbsp;<?=$count; ?>&nbsp;&nbsp;</option>
		<?PHP } ?>
	</select>
	</td>
  </tr>
  <tr>
    <td>���� �� 1 ����� (RUB):</td>
    <td align="center"><input type="text" name="1m" value="10000" size="10"/></td>
  </tr>
  <tr>
    <td>���� �� 2 ����� (RUB):</td>
    <td align="center"><input type="text" name="2m" value="5000" size="10"/></td>
  </tr>
  <tr>
    <td>���� �� 3 ����� (RUB):</td>
    <td align="center"><input type="text" name="3m" value="2500" size="10"/></td>
  </tr>
  <tr>
    <td>���� �� 4 ����� (RUB):</td>
    <td align="center"><input type="text" name="4m" value="1250" size="10"/></td>
  </tr>
  <tr>
    <td>���� �� 5 ����� (RUB):</td>
    <td align="center"><input type="text" name="5m" value="500" size="10"/></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input type="submit" value="������� �������"></td>
  </tr>
</table>
</form>

</div>
<div class="clr"></div>	
<?PHP

return;
}


# ������ ���������
if(isset($_GET["list"])){


	# ������ �������������
	$db->Query("SELECT * FROM db_invcompetition WHERE status > 0");
	if($db->NumRows() > 0){
	
	?>
	
	
	<?PHP
		while($data = $db->FetchArray()){
		
		?>
			<table width="99%" border="0" align="center">
			<tr bgcolor="#efefef">
				<td align="center" width="75" class="m-tb">ID</td>
				<td align="center" class="m-tb">�����</td>
				<td align="center" class="m-tb">��������</td>
				<td align="center" class="m-tb">����</td>
			</tr>
			<tr class="htt" >
				<td align="center"><?=$data["id"]; ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_add"]); ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_end"]); ?></td>
				<td align="center"><?=$data["1m"]+$data["2m"]+$data["3m"]+$data["4m"]+$data["5m"]; ?> RUB</td>
		 	</tr>
			<tr bgcolor="#efefef">
				<td align="center" width="75" class="m-tb">������</td>
				<td align="center" class="m-tb">1 ����� / ����</td>
				<td align="center" class="m-tb">2 ����� / ����</td>
				<td align="center" class="m-tb">3 ����� / ����</td>
				<td align="center" class="m-tb">4 ����� / ����</td>
				<td align="center" class="m-tb">5 ����� / ����</td>
			</tr>
			<tr class="htt" >
				<td align="center"><?=($data["status"] > 1) ? "�������" : "��������"; ?></td>
				<td align="center"><?=$data["user_1"]; ?> / <?=$data["1m"]; ?></td>
				<td align="center"><?=$data["user_2"]; ?> / <?=$data["2m"]; ?></td>
				<td align="center"><?=$data["user_3"]; ?> / <?=$data["3m"]; ?></td>
				<td align="center"><?=$data["user_3"]; ?> / <?=$data["4m"]; ?></td>
				<td align="center"><?=$data["user_3"]; ?> / <?=$data["5m"]; ?></td>
		 	</tr>
			</table>
		<BR /><BR />
		<?PHP
		}

	}else echo "<center><b><font color = 'red'>��� ����������� ���������</font></b></center><BR />";


?>
</div>
<div class="clr"></div>	
<?PHP

return;
}

$db->Query("SELECT * FROM db_config WHERE id = '1'");
$data_cq = $db->FetchArray();

# ������
if(isset($_POST["cancel"])){

	$cancel = intval($_POST["cancel"]);
	$db->Query("SELECT * FROM db_invcompetition WHERE status = '0' AND id = '{$cancel}' LIMIT 1");
	if($db->NumRows() == 1){
	
		$db->Query("UPDATE db_invcompetition SET user_1 = '-', user_2 = '-', user_3 = '-',user_4 = '-',user_5 = '-', status = '2' WHERE id = '$cancel'");
		$db->Query("TRUNCATE TABLE db_invcompetition_users");
		
		echo "<center><b><font color = 'green'>������� �������, ����� �� ���������</font></b></center><BR />";
		
	}else echo "<center><b><font color = 'red'>������� � ��������� ID �� ������, �������� �� ��� ��������</font></b></center><BR />";
	
}

# ���������� ��������
if(isset($_POST["set_ok"])){

	$sok = intval($_POST["set_ok"]);
	$db->Query("SELECT * FROM db_invcompetition WHERE status = '0' AND id = '{$sok}' LIMIT 1");
	if($db->NumRows() == 1){
		
		$comp_p = $db->FetchArray();
		
		$user_s = array();
		$user_s[1] = "-";
		$user_s[2] = "-";
		$user_s[3] = "-";	
		$user_s[4] = "-";	
		$user_s[5] = "-";	
		
		# ��������� �����
		$db->Query("SELECT * FROM db_invcompetition_users WHERE points > '0' ORDER BY points DESC LIMIT 3");
		if($db->NumRows() > 0){
			
			$counter = 1;
			while($data = $db->FetchArray()){
			
				$user_up_id = $data["user_id"];
				$user_s[$counter] = $data["user"];
				$money = $comp_p["{$counter}m"];
				$money = ($money * $data_cq["ser_per_wmr"]); 
				# ��������� �������� �����������
				$db->Query("UPDATE db_users_b SET money_p = money_p + '{$money}' WHERE id = '{$user_up_id}'", false, false);
				
			$counter++;
			}
		
		$db->Query("UPDATE db_invcompetition SET user_1 = '".$user_s[1]."', user_2 = '".$user_s[2]."', user_3 = '".$user_s[3]."', user_4 = '".$user_s[4]."', user_5 = '".$user_s[5]."', status = '1' WHERE id = '$sok'");
		$db->Query("TRUNCATE TABLE db_invcompetition_users");
		echo "<center><b><font color = 'green'>������� ��������, ����� ���������</font></b></center><BR />";
		
		}
		
	}else echo "<center><b><font color = 'red'>������� � ��������� ID �� ������, �������� �� ��� ��������</font></b></center><BR />";

?>
</div>
<div class="clr"></div>	
<?PHP

return;
}


$db->Query("SELECT * FROM db_invcompetition WHERE status = 0 LIMIT 1");
if($db->NumRows() == 1){
$comp = $db->FetchArray();	
	?>
<b>������� ���������� � <?=$comp["id"]; ?> � ����� �������� ������ <?=$comp["1m"]+$comp["2m"]+$comp["3m"]+$comp["4m"]+$comp["5m"]; ?> RUB<BR /><BR />
����� ��������: <?=date("d.m.Y � H:i:s", $comp["date_add"]); ?> <BR />����������: <?=date("d.m.Y � H:i:s", $comp["date_end"]); ?>
<BR /><BR />
<u>�������� �����:</u><BR />
1 - <?=$comp["1m"]; ?> RUB <BR />
2 - <?=$comp["2m"]; ?> RUB <BR />
3 - <?=$comp["3m"]; ?> RUB <BR /><BR />
4 - <?=$comp["4m"]; ?> RUB <BR /><BR />
5 - <?=$comp["5m"]; ?> RUB <BR /><BR />

<?=($comp["date_end"] < time()) ? '<center><font color = "red">!���� ��������� �������� ������!</font></center>' : false; ?>
</b>
<BR />

<table width="350" border="0" align="center">
  <tr=>
	<td align="center">
	<form action="" method="post">
		<input type="hidden" name="cancel" value="<?=$comp["id"]; ?>" />
		<input type="submit" value="�������� ��� ������"  />
	</form>
	</td>
	<td align="center">
	<form action="" method="post">
		<input type="hidden" name="set_ok" value="<?=$comp["id"]; ?>" />
		<input type="submit" value="��������� � ��������� ��������"  />
	</form>
	</td>
  </tr>
</table>
<BR />
	<?PHP
	
	# ������ �������������
	$db->Query("SELECT * FROM db_invcompetition_users WHERE points > '0' ORDER BY points DESC LIMIT 200");
	if($db->NumRows() > 0){
	
	?>
	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" width="75" class="m-tb">�������</td>
    <td align="center" class="m-tb">������������</td>
    <td align="center" class="m-tb">������</td>
	<td align="center" class="m-tb">����</td>
  </tr>
	<?PHP
		$position = 1;
		while($data = $db->FetchArray()){
		
		?>
			<tr class="htt" >
				<td align="center" width="75"><?=$position; ?></td>
				<td align="center"><?=$data["user"]; ?></td>
				<td align="center"><?=sprintf("%.0f",$data["points"]); ?></td>
				<td align="center"><?=(intval($comp["{$position}m"]) > 0) ? $comp["{$position}m"]." RUB" : "-" ?></td>
		 	</tr>
		<?PHP
		$position++;
		}
	
	?>
</table>
<BR />
	<?PHP
	
	}else echo "<center><b><font color = 'red'>��� ���������� � ��������</font></b></center><BR />";

}else echo "<center><b><font color = 'red'>� ������ ������ ������� �� ����������</font></b></center><BR />";

?>

</div>
<div class="clr"></div>	
