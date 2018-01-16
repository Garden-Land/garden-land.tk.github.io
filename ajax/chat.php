<?php
session_start();
header("Content-type: text/html; charset=utf-8");
define('MinRating', 300);
function __autoload($name){ include("../classes/_class.".$name.".php");}

class Chat{
	var $db;
	function __construct(){
		$config = new config;
		$this->db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
	}

	function send(){


		$res = $this->db->Query('SELECT `time_uban` FROM `db_chat_ban` WHERE `user` = "'.$_SESSION["user"].'"');
		if($this->db->NumRows() > 0){
			$row = $this->db->FetchArray();
			if($row['time_uban'] > time())
				return '<span style="color:#f00">Вы забанены до '.date('Y.m.d H:i', $row['time_uban']).'</span>';
		}
		if(trim($_POST['comment']) == NULL)
			return '<span style="color:#000">Введите сообщение</span>';




		$res = $this->db->Query('SELECT `time` FROM `db_chat` WHERE `user` = "'.$_SESSION["user"].'" ORDER BY `id` ASC  LIMIT 1');
		$lasttime = $this->db->FetchRow();
		if($lasttime > time()- 1)
			return '<span style="color:#f00">Нельзя отправлять сообщения так часто.</span>';

		$comm = base64_encode($this->db->RealEscape($_POST['comment']));
		$this->db->Query('INSERT INTO `db_chat` (`user`, `to`, `comment`, `time`) VALUES ("'.$_SESSION["user"].'", "'.$this->db->RealEscape($to).'", "'.$comm.'", "'.time().'")');

	    $this->db->Query('UPDATE db_users_b SET money_b = money_b WHERE `user` = "'.$_SESSION["user"].'"');
		$this->db->Query('SELECT * FROM db_users_a WHERE `user` = "'.$_SESSION["user"].'"');
		$user_dataa = $this->db->FetchArray();
		$refid=$user_dataa["referer_id"];
		$resss = $this->db->Query('SELECT `money_b`, `user` FROM `db_users_b` WHERE `user` = "'.$refid.'"');
		$rowss = $this->db->FetchArray();
		$this->db->Query('UPDATE db_users_b SET money_b = money_b WHERE `id` = "'.$refid.'"');

		$this->db->Query('DELETE FROM `db_chat` WHERE `id` < '.($this->db->LastInsert() - 100));
		return '<span style="color:#0f0">Сообщение отправлено</span>';
	}

	function get(){
		$res = $this->db->Query('SELECT `chat_moder` FROM `db_users_a` WHERE `user` = "'.$_SESSION["user"].'"');
		$chat_moder = $this->db->FetchRow();
		$res = $this->db->Query('SELECT * FROM `db_chat` ORDER BY `id`  ASC');
		$res = $this->db->Query('SELECT db_chat.comment,db_chat.time,db_chat.user,db_chat.id,db_chat.to, db_users_a.chat_moder FROM `db_chat`,`db_users_a` WHERE db_chat.user = db_users_a.user  ORDER BY db_chat.id  DESC');

		$str = NULL;
		while($row = $this->db->FetchArray()){
			$str .= $this->get_str($row, $chat_moder);
		}
		return $str;
	}

	function get_str($row, $chat_moder){

	$comm = base64_decode($row['comment']);

		$moderresss = $row['chat_moder'];
  if($moderresss == 1)
  {$str .= '<span class="user" style="color:#d82020;"> '.htmlspecialchars($row['user']).'</span> <span style="padding:2px 5px 0px 10px;"> '.date('H:i', $row['time']).' : </span>  <font color="#8e561d">'.$this->bb_code($comm).'</font>';}
  if($moderresss != 1)
  {$str .= ' <span class="user" style="color:#000;"> '.htmlspecialchars($row['user']).'</span> <span style="padding:2px 5px 0px 10px;"> '.date('H:i', $row['time']).' : </span>   <font color="#383333">'.$this->bb_code($comm).'</font>';}

		if($row['to'] == $_SESSION["user"])
			$str = '<span class="to">'.$str.'</span>';

		if($chat_moder == 1)
			$str .= ' (
			<a href="/chat/del/'.$row['id'].'" title="Удалить">Удалить.</a>
			<a href="/chat/ban/'.$row['user'].'" title="Забанить/Розбанить пользователя">Бан/Розбан</a>)';

		$str = $str.'<br />';

		if($row['type'] == 1){
			if($chat_moder != 1 AND $row['to'] != $_SESSION["user"] AND $row['user'] != $_SESSION["user"])
				$str = NULL;
			else
				$str = '<span class="private">'.$str.'</span>';

		}

		return $str;
	}

  function get_online(){

    $res = $this->db->Query("DELETE FROM `db_chat_online` WHERE time < '".(time() - 10)."'");

    $res = $this->db->Query('SELECT * FROM `db_chat_online` ORDER BY `time` ASC');
		$str = '<div style="dispay: block; text-align: center; color: red;">Online</div>';
    $is_est = 0;

		while($row = $this->db->FetchArray()){

     //print_r($row);

     if ($row['user_id'] == $_SESSION["user_id"])
     {
       $is_est = 1;
     }
     $str .= '<span class="user" style="display: block;">'.htmlspecialchars($row['user']).'</span>';

    }

    if (!$is_est)
    {


      $this->db->Query('INSERT INTO `db_chat_online` (`user`, `time`, `user_id`) VALUES ("'.$_SESSION["user"].'", "'.time().'", "'.$_SESSION["user_id"].'")');

      $str .= '<span class="user" style="display: block;">'.htmlspecialchars($_SESSION['user']).'</span>';
    }
    else
    {
      $this->db->Query('UPDATE `db_chat_online` SET time = "'.time().'" WHERE user_id = "'.$_SESSION["user_id"].'"');

    }
		return $str;
	}

	function _echo($str){
		echo $str;
	}

	function bb_code($str){
		$str = htmlspecialchars($str);
		$str = preg_replace('#\[b\](.+?)\[/b]#', '<span style="font-weight:900;">$1</span>',$str);
		$str = preg_replace('#\[i\](.+?)\[/i]#', '<span style="font-style:italic;">$1</span>',$str);
		$str = preg_replace('#\[u\](.+?)\[/u]#', '<span style="text-decoration:underline;">$1</span>',$str);
		$str = preg_replace('#\[s\](.+?)\[/s]#', '<span style="text-decoration:line-through;">$1</span>',$str);
                $str = preg_replace('#\[hl\](.+?)\[hl/]#', '<span style="text-decoration:line-through;">$1</span>',$str);
                $str = preg_replace( '#\[color\s?=\s?(.+?)\](.+?)\[\/color\]#', '<span style="color: $1;">$2</span>', $str);

		$str = preg_replace('#\*stop\*#', '<img src="/img/chat/smile/stop.gif" alt="" />',$str);
		$str = preg_replace('#\*unsmile\*#', '<img src="/img/chat/smile/unsmile.gif" alt="" />',$str);
		$str = preg_replace('#\*wonder\*#', '<img src="/img/chat/smile/wonder.gif" alt="" />',$str);
		$str = preg_replace('#\*inlove\*#', '<img src="/img/chat/smile/inlove.gif" alt="" />',$str);
		$str = preg_replace('#\*dance\*#', '<img src="/img/chat/smile/dance.gif" alt="" />',$str);
		$str = preg_replace('#\*tup\*#', '<img src="/img/chat/smile/tup.gif" alt="" />',$str);
		$str = preg_replace('#\*dont\*#', '<img src="/img/chat/smile/dont.gif" alt="" />',$str);

		$str = preg_replace('#\*kez_02\*#', '<img src="/img/chat/smile/kez_02.gif" alt="" />',$str);
		$str = preg_replace('#\*alvarin_34\*#', '<img src="/img/chat/smile/alvarin_34.gif" alt="" />',$str);
		$str = preg_replace('#\*drag_06\*#', '<img src="/img/chat/smile/drag_06.gif" alt="" />',$str);
		$str = preg_replace('#\*kidrock_07\*#', '<img src="/img/chat/smile/kidrock_07.gif" alt="" />',$str);
		$str = preg_replace('#\*shoot2\*#', '<img src="/img/chat/smile/shoot2.gif" alt="" />',$str);
		$str = preg_replace('#\*helpless\*#', '<img src="/img/chat/smile/helpless.gif" alt="" />',$str);
		$str = preg_replace('#\*boyan\*#', '<img src="/img/chat/smile/boyan.gif" alt="" />',$str);
		$str = preg_replace('#\*rofl\*#', '<img src="/img/chat/smile/rofl.gif" alt="" />',$str);
		$str = preg_replace('#\*devil\*#', '<img src="/img/chat/smile/devil.gif" alt="" />',$str);
		$str = preg_replace('#\*smoke\*#', '<img src="/img/chat/smile/smoke.gif" alt="" />',$str);
		$str = preg_replace('#\*burumburum\*#', '<img src="/img/chat/smile/burumburum.gif" alt="" />',$str);
		$str = preg_replace('#\*spasibo\*#', '<img src="/img/chat/smile/spasibo.gif" alt="" />',$str);
		$str = preg_replace('#\*draznilka\*#', '<img src="/img/chat/smile/draznilka.gif" alt="" />',$str);
		$str = preg_replace('#\*popa\*#', '<img src="/img/chat/smile/popa.gif" alt="" />',$str);
		$str = preg_replace('#\*smutili\*#', '<img src="/img/chat/smile/smutili.gif" alt="" />',$str);
		$str = preg_replace('#\*mmmm\*#', '<img src="/img/chat/smile/mmmm.gif" alt="" />',$str);
		$str = preg_replace('#\*yazyk\*#', '<img src="/img/chat/smile/yazyk.gif" alt="" />',$str);
		$str = preg_replace('#\*beer3\*#', '<img src="/img/chat/smile/beer3.gif" alt="" />',$str);
		$str = preg_replace('#\*prostite\*#', '<img src="/img/chat/smile/prostite.gif" alt="" />',$str);
		$str = preg_replace('#\*beat\*#', '<img src="/img/chat/smile/beat.gif" alt="" />',$str);
                $str = preg_replace('#\*clap\*#', '<img src="/img/chat/smile/clap.gif" alt="" />',$str);
                $str = preg_replace('#\*music\*#', '<img src="/img/chat/smile/music.gif" alt="" />',$str);
                $str = preg_replace('#\*bye\*#', '<img src="/img/chat/smile/bye.gif" alt="" />',$str);
                $str = preg_replace('#\*kiss\*#', '<img src="/img/chat/smile/kiss.gif" alt="" />',$str);
                $str = preg_replace('#\*lol\*#', '<img src="/img/chat/smile/lol.gif" alt="" />',$str);
                $str = preg_replace('#\*pissed\*#', '<img src="/img/chat/smile/pissed.gif" alt="" />',$str);
                $str = preg_replace('#\*hilarious\*#', '<img src="/img/chat/smile/hilarious.gif" alt="" />',$str);
		return $str;
	}
}

$chat = new Chat();

if($_GET['p'] == 'send'){
	$chat->_echo($chat->send());
}

if($_GET['p'] == 'online'){
	$chat->_echo('
			<script type="text/javascript">
				$(function(){
					$(\'#chat #chat-online .user\').click(function(){
						$(\'#chat .message input[name="comment"]\').val($(this).text() + \', \' + $(\'#chat .message input[name="comment"]\').val());
						$(\'#chat .message input[name="to"]\').val($(this).text());
					});
				});
			</script>'.$chat->get_online());
}

if($_GET['p'] == 'get'){
	$chat->_echo('
			<script type="text/javascript">
				$(function(){
					$(\'#chat #chat_scroll .user\').click(function(){
						$(\'#chat .message input[name="comment"]\').val($(this).text() + \', \' + $(\'#chat .message input[name="comment"]\').val());
						$(\'#chat .message input[name="to"]\').val($(this).text());
					});
				});
			</script>'.$chat->get());
}
?>