<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer3">
<h3>
<center><img src="/img/fk.png"></center>
</h3>

<center>
<?PHP
$_OPTIMIZATION["title"] = "Пополнить баланс";
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


<?

$fk_merchant_id = '30246'; //merchant_id ID мазагина в free-kassa.ru https://free-kassa.ru/merchant/cabinet/help/
$fk_merchant_key = 'k6kfn7b9'; //Секретное слово https://free-kassa.ru/merchant/cabinet/profile/tech.php


?>
<script type="text/javascript">
var min = 1;
var ser_pr = 100;
function calculate(st_q) {

	var sum_insert = parseInt(st_q);
	$('#res_sum').html( (sum_insert * ser_pr) );

	var re = /[^0-9\.]/gi;
    var url = window.location.href;
    var desc = '<?=$usid;?>';
    var sum = $('#sum').val();
    if (re.test(sum)) {
        sum = sum.replace(re, '');
        $('#oa').val(sum);
    }
    if (sum < min) {
        $('#error').html('Сумма должна быть больше '+min);
		$('#submit').attr("disabled", "disabled");
        return false;
    } else {
        $('#error').html('');
    }

    $.get('/free-kassa-data.php?prepare_once=1&l='+desc+'&oa='+sum, function(data) {
         var re_anwer = /<hash>([0-9a-z]+)<\/hash>/gi;
         $('#s').val(re_anwer.exec(data)[1]);
         $('#submit').removeAttr("disabled");
    });
}

</script>

<div id="error3"></div>
<form method=GET action="https://www.free-kassa.ru/merchant/cash.php">
    <input type="hidden" name="m" value="<?=$fk_merchant_id?>">
Сумма рублей:  <input type="text" name="oa" id="sum" class="box" style="margin:0px; height:40px; width:170px;" value="100" size="7" id="oa" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)">
    <input type="hidden" name="s" id="s" value="0"> 
	<input type="hidden" name="us_id" id="us_id" value="<?=$usid;?>">
    <br>
    <input type="hidden" name="o" id="desc" value="<?=$usid;?>" />
    <br>
    <input type="submit" id="submit" class="button" value="Пополнить баланс" >
</form>
<script type="text/javascript">
calculate();
</script>
</center>

</center>
</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>

