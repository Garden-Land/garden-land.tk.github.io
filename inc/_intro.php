<div style="width:1000px; margin:0 auto;">
<div class="text-intro">

<div style="width:675px; color:#4d2e09; font-size:15px; margin:30px 0px 0px 20px; float:left;">
<h3>Добро пожаловать в Garden-land</h3>
<b>Присоединяйтесь бесплатно к фермерам проекта Garden-land и получите в подарок 150 монет. Полученный бонус вы сможете использовать для покупок. Выращивайте урожай и продавайте его за кристаллы. Кристаллы вы сможете вывести в любое удобное для вас время. Не упустите
возможность зарабатывать играя с друзьями в Garden-land.</b>
</div>


<div style="width:255px; float:right; margin:60px 0px 0px 20px;">

<img src="/img/st-title.png">
<div class="space"></div>
<?PHP
$tfstats = time() - 60*60*24;
$db->Query("SELECT
(SELECT COUNT(*) FROM db_users_a) all_users,
(SELECT SUM(insert_sum) FROM db_users_b) all_insert,
(SELECT SUM(payment_sum) FROM db_users_b) all_payment,
(SELECT COUNT(*) FROM db_users_a WHERE date_reg > '$tfstats') new_users");
$stats_data = $db->FetchArray();
?>

<div style="float:left; color:#f1dfa5; font-size:14px; width:100px;">Игроков:</div> <div style="float:left; padding:0px 0px 0px 0px; color:#f8edc9; width:118px; text-align:right;"><b><?=$stats_data["all_users"]; ?></b></div>
<div class="space"></div>
<div style="float:left; color:#f1dfa5; font-size:14px; width:100px;">Выплачено:</div> <div style="float:left; padding:3px 0px 0px 0px; color:#f8edc9;  width:118px; text-align:right;"><img src="/img/diamon.png" width="24"><div style="margin-top:-3px; margin-left:5px; float:right;"><b><?=sprintf("%.2f",$stats_data["all_payment"])+787.63; ?></b></div></div>
<div class="space"></div>
<div style="float:left; color:#f1dfa5; font-size:14px; width:100px;">В резерве:</div> <div style="float:left; padding:3px 0px 0px 0px; color:#f8edc9;  width:118px; text-align:right;"><img src="/img/coin.png" width="22"><div style="margin-top:-3px; margin-left:5px; float:right;"><b><?=sprintf("%.2f",$stats_data["all_insert"] - $stats_data["all_payment"])+76438.13; ?></b></div></div>



</div>




</div>
</div>

</div>