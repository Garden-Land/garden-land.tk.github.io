<style>


.ttb td {
background: #33A049;
color: #FFFFFF;
border: 1px solid #33A049;
}
.ltb {
background: #E1FFC4;
border-bottom: 1px solid #33A049;
}
.ltb td {
border: 1px solid #33A049;
}
</style>
<?PHP
######################################
#������ ������ �������
#����� INVEST-CMS.NET
######################################
$_OPTIMIZATION["title"] = "������������ ������";
$_OPTIMIZATION["description"] = "������ �������";
$_OPTIMIZATION["keywords"] = "������ �������";
# ��� ������� ���� ������ =\
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
# ���� �� ����� �� ���. ���������
?>
<div class="s-bk-lf">
	<div class="acc-title">������������ ������</div>
</div>
<div class="silver-bk"><div class="clr"></div>	


<BR />

<?PHP
$db->Query("SELECT * FROM db_users_a WHERE time_online > ".time()." ORDER by time_online DESC");
$colsp=$db->NumRows();
if($colsp>0){
?>


<table cellpadding="4" cellspacing="0" align="center" width="100%" class="table_info">
<tbody><tr align="center" class="ttb">
	<td><b>�����</b></td>
	<td><b>��������</b></td>
	<td><b>������</b></td>
	<td><b>���</b></td>
</tr>
<?PHP
while($arr=$db->FetchArray()){
?>
<tr align="center" class="ltb">
		<td><?=$arr["user"]; ?></td>
		<td><?=$arr["wheres"]; ?></td>
		<td><?if($arr['user']=='admin'){ ?>RU<?}else{ echo $arr['country'];}?></td>
                <td><?PHP
$timek=round((time()+5*60-$arr['time_online'])/60,0);
if($timek==0){echo '<font color ="green">������</font>'; }else{ echo $timek.'<font color ="red"> ���. �����</font>'; }
?></td>
	</tr>
	<?PHP
	}
?>
</tbody></table>
<br>
<center>
����� <?=$colsp;?> ������������� ������ ������ �� ������ �������.</td></center>
<?PHP
}else{
?>
<? }
#
?>
</div>



  <!--script LANGUAGE="JavaScript1.1">
document.oncontextmenu = function(){return false;};
</script--> 


