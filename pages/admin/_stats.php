
<div class="acc-title">������4��</div>
	<div class="field-gr"><a href="/?menu=gardener&sel=stats">����������</a></div>
        <div class="field-gr"><a href="/?menu=gardener&sel=users">������������</a></div>
	<div class="field-gr"><a href="/?menu=gardener&sel=news">�������</a></div>
        <div class="field-gr"><a href="/?menu=gardener&sel=invcompconfig">������� ����������</a></div>
        <div class="field-gr"><a href="/?menu=gardener&sel=config">���������</a></div>
	
	
	
<div class="s-bk-lf">
	<div class="acc-title">���������� �������</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP

$db->Query("SELECT 
	COUNT(id) all_users, 
	SUM(money_b) money_b, 
	SUM(money_p) money_p, 
	
	SUM(a_t) a_t, 
	SUM(b_t) b_t, 
	SUM(c_t) c_t, 
	SUM(d_t) d_t, 
	SUM(e_t) e_t, 
	
	SUM(a_b) a_b, 
	SUM(b_b) b_b, 
	SUM(c_b) c_b, 
	SUM(d_b) d_b, 
	SUM(e_b) e_b, 
	
	SUM(all_time_a) all_time_a, 
	SUM(all_time_b) all_time_b, 
	SUM(all_time_c) all_time_c, 
	SUM(all_time_d) all_time_d, 
	SUM(all_time_e) all_time_e,
	
	SUM(payment_sum) payment_sum, 
	SUM(insert_sum) insert_sum
	
	
	FROM db_users_b");
$data_stats = $db->FetchArray();

?>

<table width="450" border="0" align="center">
  <tr class="htt">
    <td><b>���������������� �������������:</b></td>
	<td width="100" align="center"><?=$data_stats["all_users"]; ?> ���.</td>
  </tr>
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>������� �� ������ (��� �������):</b></td>
	<td width="100" align="center"><?=sprintf("%.0f",$data_stats["money_b"]); ?></td>
  </tr>
  
  <tr class="htt">
    <td><b>������� �� ������ (�� �����):</b></td>
	<td width="100" align="center"><?=sprintf("%.0f",$data_stats["money_p"]); ?></td>
  </tr>
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>������� �������� (����):</b></td>
	<td width="100" align="center"><?=intval($data_stats["a_t"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>������� �������� (�����):</b></td>
	<td width="100" align="center"><?=intval($data_stats["b_t"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>������� �������� (��������):</b></td>
	<td width="100" align="center"><?=intval($data_stats["c_t"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>������� �������� (����):</b></td>
	<td width="100" align="center"><?=intval($data_stats["d_t"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>������� �������� (��������):</b></td>
	<td width="100" align="center"><?=intval($data_stats["e_t"]); ?> ��.</td>
  </tr>
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>�� ������� (����):</b></td>
	<td width="100" align="center"><?=intval($data_stats["a_b"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>�� ������� (�����):</b></td>
	<td width="100" align="center"><?=intval($data_stats["b_b"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>�� ������� (��������):</b></td>
	<td width="100" align="center"><?=intval($data_stats["c_b"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>�� ������� (����):</b></td>
	<td width="100" align="center"><?=intval($data_stats["d_b"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>�� ������� (��������):</b></td>
	<td width="100" align="center"><?=intval($data_stats["e_b"]); ?> ��.</td>
  </tr>
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>������� �� ��� ����� (����):</b></td>
	<td width="100" align="center"><?=intval($data_stats["all_time_a"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>������� �� ��� ����� (�����):</b></td>
	<td width="100" align="center"><?=intval($data_stats["all_time_b"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>������� �� ��� ����� (��������):</b></td>
	<td width="100" align="center"><?=intval($data_stats["all_time_c"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>������� �� ��� ����� (����):</b></td>
	<td width="100" align="center"><?=intval($data_stats["all_time_d"]); ?> ��.</td>
  </tr>
  
  <tr class="htt">
    <td><b>������� �� ��� ����� (��������):</b></td>
	<td width="100" align="center"><?=intval($data_stats["all_time_e"]); ?> ��.</td>
  </tr>
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>������� ��������������:</b></td>
	<td width="100" align="center"><?=sprintf("%.2f",$data_stats["insert_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  
  <tr class="htt">
    <td><b>��������� �������������:</b></td>
	<td width="100" align="center"><?=sprintf("%.2f",$data_stats["payment_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  
</table>

</div>
<div class="clr"></div>	