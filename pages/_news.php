<?PHP
$_OPTIMIZATION["title"] = "Новости";
$_OPTIMIZATION["description"] = "Новости проекта";
$_OPTIMIZATION["keywords"] = "Новости нашего проекта";
?>
<div class="content">
<div class="content-panel">

<h3>
<center>Новости проекта</center>
</h3>
<div class="layer">
<?PHP

$db->Query("SELECT * FROM db_news ORDER BY id DESC");

if($db->NumRows() > 0){

	while($news = $db->FetchArray()){
	
	?>

            
<div style="width:850px; height:30px; border-bottom:1px solid #b3a064; padding:10px 10px 10px 10px; background:#f6eac3;">

<div style="float:left; font-size:18px; margin-top:-3px; width:600px;"><?=$news["title"]; ?></div>
<div style="float:right;"><?=date("d.m.Y",$news["date_add"]); ?></div>

</div>

<div class="clr"></div>
<div style="margin-left:10px;">
<?=$news["news"]; ?>
</div>

	<?PHP
	
	}

}else echo "<center>Новостей нет</center>";

?>
</div>
</div>
</div>
<div class="clr"></div>
<?PHP include("inc/_intro.php"); ?>