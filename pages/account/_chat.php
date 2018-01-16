<?PHP
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();



/*
if($_SESSION["user_id"] != 1){
echo "<center><b><font color = red>Технические работы</font></b></center>";
return;
}
*/
?>


<div style="margin:0 auto; width:1000px;">


<script type="text/javascript" src="https://yandex.st/jquery/1.6.2/jquery.min.js"></script>
<script LANGUAGE="JavaScript1.1"> 
document.oncontextmenu = function(){return false;}; 
</script>	

<?php
if(!isset($_SESSION["user"]))
	return;
	
header("Content-type: text/html; charset=windows-1251");
$db->query("SET NAMES cp1251");
?>
<script type="text/javascript" src="/js/cookies.js" /></script>

<script type="text/javascript" src="/js/jqu.js" /></script>
<script type="text/javascript">
function insert_comm(open, close, no_focus)
{
  msgfield = (document.all) ? document.all.forma_com : document.forms['form_com']['comment'];
  if (document.selection && document.selection.createRange)
  {
    if (no_focus != '1' ) msgfield.focus();
	sel = document.selection.createRange();
	sel.text = open + sel.text + close;
	if (no_focus != '1' ) msgfield.focus();
	}else if (msgfield.selectionStart || msgfield.selectionStart == '0'){
	  var startPos = msgfield.selectionStart;
	  var endPos = msgfield.selectionEnd;
	  msgfield.value = msgfield.value.substring(0, startPos) + open + msgfield.value.substring(startPos, endPos) + close + msgfield.value.substring(endPos, msgfield.value.length);
	  msgfield.selectionStart = msgfield.selectionEnd = endPos + open.length + close.length;
	  if (no_focus != '1' ) msgfield.focus();
	    }else{
		msgfield.value += open + close;
		if (no_focus != '1' ) msgfield.focus();
		}return;}
		
		function reset_chat(){
			$.ajax({
				type: "POST",
				url: "/ajax/chat.php?p=get",
				data: "",
				success: function(result){
					if($("#chat #chat_scroll").html() != result)
						$("#chat #chat_scroll").html(result);
						$("#chat #chat_scroll").scrollTo(9999);					
				}
			});
		}
    
    function reset_online(){
			$.ajax({
				type: "POST",
				url: "/ajax/chat.php?p=online",
				data: "",
				success: function(result){
					
						$("#chat #chat-online").html(result);
								
        }
			});
		}
		
		function reset_warning(){
			$("#chat .bbcode #warnings").text('');
		}
		
		function swich_close(){
			$('body').css('padding-bottom', '7px');
			$('#chat').css('bottom', '-150px');
			$.cookie('swich', 'close');
		}
		
		function swich_open(){
			$('body').css('padding-bottom', '157px');
			$('#chat').css('bottom', '-0px');
			$.cookie('swich', 'open');
		}
		
		$(function(){	
		
			reset_chat();
      reset_online();
			
			setInterval(reset_chat, 700);
      setInterval(reset_online, 5000);
			setInterval(reset_warning, 9000);
								
			$('#chat #form_com').submit(function(e){
				e.preventDefault();	
				$.ajax({
					type: "POST",
					url: "/ajax/chat.php?p=send",
					data: $('#chat #form_com').serialize(),
					success: function(result){
						$("#chat .bbcode #warnings").html(result);
						if(result == '<span style="color:#0f0">Сообщение отправлено</span>'){
							$('#chat .message input[name="comment"]').val('');
							reset_chat();
						}
					}
				});					
						
			});
			
			$('#chat #chat_scroll .user').click(function(){
      
				$('#chat .message input[name="comment"]').val($(this).text() + $('#chat .message input[name="comment"]').val());
			});
      
      $('#chat #chat-online .user').click(function(){
       
				$('#chat .message input[name="comment"]').val($(this).text() + $('#chat .message input[name="comment"]').val());
			});
			
		});
</script>
<style type="text/css" href="/style/style.css">

#chat{position:relative;
bottom:<?php
if(!isset($_SESSION['chathide']))
	$_SESSION["chathide"] = false;

if(isset($_GET['chats'])){
	if($_SESSION['chathide'] == false)
		$_SESSION["chathide"] = true;
	else
		$_SESSION["chathide"] = false;
}

echo $_SESSION['chathide'] == false?'10':'-155';
?>px; margin-left:15px; margin-top:45px; width:880px; padding:15px 10px 2px 12px; z-index:1;}
#chat #chat_scroll{height:140px; width:670px; display: inline-block; font-size:14px; padding:2px; overflow-y: scroll; line-height:20px;}
#chat .swich{position:absolute; display:block; right:-2px; top:-31px; cursor:pointer; height:33px; width:155px; background:url(/img/chat/swich.png); text-align:center; line-height:33px;}
#chat #chat_scroll .user{font-weight:900; color:00f; text-decoration:underline; cursor:pointer;}
#chat #chat_scroll .user:hover{text-decoration:none;}
#chat #chat-online .user:hover{text-decoration:none;}
#chat #chat_scroll .to{background:#000;}
#chat #chat_scroll .private{color:#000;}
#chat #chat_scroll .time{color:#000; float:left;}
#chat .message input[name="comment"]{background:#fff;
float:left;
border:1px solid #7d4814;	
width:240px;
border-radius:12px;
box-shadow: inset 10px 0px 20px rgba(208,212,213,0.2);
margin:8px 6px 5px 0px;
padding:0px 10px 0px 10px;	
height:40px;
font-size:16px;}
#chat .message input[name="message_sub"]{
	-moz-box-shadow:inset 0px 1px 0px 0px #713f0e;
	-webkit-box-shadow:inset 0px 1px 0px 0px #713f0e;
	box-shadow:inset 0px 1px 0px 0px #713f0e;
	background:#ce9965;
	border-radius:12px;
	text-decoration:none;
	border: none;
	color:#FFFFFF;
	width:240px;
	padding:10px 0px 12px 0px;
	margin:0px 6px 5px 0px;
	cursor:pointer;
	font-size:20px;
	font-family: 'PT Sans', sans-serif;}
</style>
<div id="chat">
<div style="float:left; width:450px;">	
	<div id="chat_scroll">Загрузка...</div>
</div>		
	
  
  <div style="float:right; width:160px;">
	<div class="message">
		<form id="form_com" action="#form_com" method="post">
			<input type="text" id="comment" placeholder="Сообщение" name="comment" maxlength="255" />
			<input type="hidden" name="to" />
			<div style="width:240px; padding:5px 0px 3px 0px; margin-bottom:5px; border-radius:12px; clear:both; background:#f0e2b8;">
			<div class="bbcode">

<img onclick="insert_comm('','*rofl*')" src="/img/chat/smile/rofl.gif" alt="" />
<img onclick="insert_comm('','*devil*')" src="/img/chat/smile/devil.gif" alt="" />
<img onclick="insert_comm('','*beat*')" src="/img/chat/smile/beat.gif" alt="" />
<img onclick="insert_comm('','*spasibo*')" src="/img/chat/smile/spasibo.gif" alt="" />
<img onclick="insert_comm('','*popa*')" src="/img/chat/smile/popa.gif" alt="" />
<img onclick="insert_comm('','*smutili*')" src="/img/chat/smile/smutili.gif" alt="" />
<img onclick="insert_comm('','*prostite*')" src="/img/chat/smile/prostite.gif" alt="" />
<img onclick="insert_comm('','*bye*')" src="/img/chat/smile/bye.gif" alt="" />
</div>
</div>
			 <input type="submit" name="message_sub" value="Отправить" />
</div> 
</div>	
</div>		 
		</form>
</div>	

</div>							







	


