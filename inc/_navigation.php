
<div class="nav-line"></div>
<div class="navigation-panel">
<div class="navigation">

<div class="logo">
<a href="/"><img src="/img/logo.png" width="180"></a>
</div>

<div class="menu">
<a href="/about"><b>ОБ ИГРЕ</b></a>
<a href="/news"><b>НОВОСТИ</b></a>
<a href="/faq"><b>FAQ</b></a>
<a href="/statistic"><b>СТАТИСТИКА</b></a>
<a href="/support"><b>СВЯЗЬ</b></a>



<?PHP

if(isset($_SESSION["user"]) OR isset($_SESSION["admin"])){

	if(isset($_SESSION["admin"]) AND isset($_GET["menu"]) AND $_GET["menu"] == "nova-panel"){
	
		include("inc/_admin_menu.php");
	
	}elseif(isset($_SESSION["user"])){ 
		?>

        
<div class="money-panel">
<div style="float:left; width:50px;">
<img src="/img/coin.png" width="45">
</div>
<div style="float:left; min-width:100px;">
<a href="/insert"><b>{!BALANCE_B!}</b></a>
</div>

<div style="float:left; padding:0px 0px 0px 20px; width:50px;">
<img src="/img/diamon.png" width="45">
</div>
<div style="float:left; min-width:100px;">
<a href="/out"><b>{!BALANCE_P!}</b></a>
</div>

</div>
		<?
		}
}
?>
</div>

<div class="login">
<?PHP

if(isset($_SESSION["user"]) OR isset($_SESSION["admin"])){

	if(isset($_SESSION["admin"]) AND isset($_GET["menu"]) AND $_GET["menu"] == "nova-panel"){
	
		include("inc/_admin_menu.php");
	
	}elseif(isset($_SESSION["user"])){ 
		?>

        
<?PHP include("inc/_user_menu.php"); ?>

<div class="log-panel-bg">
         <div style="float:left; padding-right:5px;"><img src="/img/user.png" width="35"></div><div style="float:left;  padding:5px 0px 0px 0px;"><a href="/my-farm" title="Личный кабинет"><font color="#8a3f02"><b>моя ферма</b></font></a></div>
		 <div class="clr"></div>
		 <div style="float:left; padding-right:5px;"><img src="/img/settings.png" width="35"></div><div style="float:left;  padding:5px 0px 0px 0px;"><a href="/settings" title="настройки"><font color="#708e3d"><b>настройки</b></font></a></div>
		 <div class="clr"></div>
         <div style="float:left; padding-right:5px;"><img src="/img/exit.png" width="35"></div><div style="float:left;  padding:5px 0px 0px 0px;"><a href="/exit" title="покинуть игру"><font color="#ba2f24"><b>выход</b></font></a></div>
		 
		 
</div>
		<?
		}else include("inc/_enter.php");
	
}else include("inc/_enter.php");
?>
</div>

</div>
</div>