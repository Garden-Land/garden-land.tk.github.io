<?PHP
$_OPTIMIZATION["title"] = "������������� ����";
$_OPTIMIZATION["description"] = "";
$_OPTIMIZATION["keywords"] = "";
?>
<div class="s-bk-lf">
	<div class="acc-title">������������� ����</div>
</div>
<div class="silver-bk">
<?php
$res = $db->Query('SELECT `chat_moder` FROM `db_users_a` WHERE `user` = "'.$_SESSION["user"].'"');
$chat_moder = $db->FetchRow();

if($chat_moder != 1){
	echo '�� �� ���������!!!';
	return;
}

if($_GET['t'] == 'ban'){
	$res = $db->query('SELECT `time_uban` FROM `db_chat_ban` WHERE `user` = "'.$db->RealEscape($_GET['id']).'" AND `time_uban` > '.time());

	if($db->NumRows() == 0){
		if(isset($_POST['ban_sub'])){
			$db->query('DELETE FROM `db_chat_ban` WHERE `user` = "'.$db->RealEscape($_GET['id']).'"');
			$db->query('INSERT INTO `db_chat_ban` (`user`, `time_uban`) VALUES ("'.$db->RealEscape($_GET['id']).'", '.(time() + intval(abs($_POST['time_uban']) * 86400)).')');
			echo '������������ �������';
			return;
		}

		echo '<form action="" method="post">�������� �� <input name="time_uban" type="text" value="1" size="5" /> ����. <input name="ban_sub" type="submit" value="��������" /></form>';
	}else{
		$db->query('DELETE FROM `db_chat_ban` WHERE `user` = "'.$db->RealEscape($_GET['id']).'"');
		echo '������������ ��������';
		return;
	}
}

if($_GET['t'] == 'del'){
	$db->query('DELETE FROM `db_chat` WHERE `id` = '.intval($_GET['id']));
	echo '�������';
	return;
}

if($_GET['t'] == 'edit'){
	$res = $db->Query('SELECT `comment` FROM `db_chat` WHERE `id` = '.intval($_GET['id']));

	if($db->NumRows() == 0){
		echo '��������� �� �������';
		return;
	}

	if(isset($_POST['edit_sub'])){
	$c = base64_encode($db->RealEscape($_POST['comment']));
		$db->Query('UPDATE `db_chat` SET `comment` = "'.$c.'" WHERE `id` = '.intval($_GET['id']));
		echo '���������';
		return;
	}

	$comment = $db->FetchRow();

	echo '<form action="" method="post">
		<input name="comment" type="text" value="'.base64_decode(htmlspecialchars($comment)).'" size="60" />
		<input name="edit_sub" type="submit" value="���������" />
	</form>';

	return;
}
?>
</div>
<div class="clr"></div>