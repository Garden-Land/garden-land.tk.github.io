
<div class="prof">
<div class="myfarm-menu-left">
<?PHP include("inc/_menu-left.php"); ?>
</div>

<div class="prof-content">
<div class="layer2">

<?PHP
$_OPTIMIZATION["title"] = "Лавка";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# Покупка нового дерева
if(isset($_POST["item"])){

$array_items = array(1 => "a_t", 2 => "b_t", 3 => "c_t", 4 => "d_t", 5 => "e_t", 6 => "f_t");
$array_name = array(1 => "Абрикос", 2 => "Груша", 3 => "Персик", 4 => "Яблоко", 5 => "Банан", 6 => "Апельсин");
$item = intval($_POST["item"]);
$citem = $array_items[$item];

	if(strlen($citem) >= 3){
		
		# Проверяем средства пользователя
		$need_money = $sonfig_site["amount_".$citem];
		if($need_money <= $user_data["money_b"]){
		
			if($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > ( time() - 60*20) ){
				
				$to_referer = $need_money * 0.1;
				# Добавляем дерево и списываем деньги
				$db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + 1,  
				last_sbor = IF(last_sbor > 0, last_sbor, '".time()."') WHERE id = '$usid'");
				
				# Вносим запись о покупке
				$db->Query("INSERT INTO db_stats_btree (user_id, user, tree_name, amount, date_add, date_del) 
				VALUES ('$usid','$usname','".$array_name[$item]."','$need_money','".time()."','".(time()+60*60*24*15)."')");
				
				?>
			                            <div id="parent_popup">
				   <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>Удачная покупка!</h4>
                Вы успешно совершили покупку. 
                </div>

				<a class="close" title="«акрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>
				<?
				
				$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
				$user_data = $db->FetchArray();
				
			}else    						{
?>
				<div id="parent_popup">
				   <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>Ошибка</h4>
                Перед новой покупкой соберите всю прибыль на вашей ферме. 
                </div>

				<a class="close" title="«акрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

						}
		
		}else    						{
?>
				<div id="parent_popup">
				  				  <div id="popup">
				<div style="width:260px; float:left; padding:21px 0px 0px 120px">
				<h4>Ошибка</h4>
                Недостаточно средств для покупки данного товара. 
                </div>

				<a class="close" title="«акрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
				  </div>
				</div>
				<script type="text/javascript">
					var delay_popup = 100;
					setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
				</script>

<?

						}
	
	}else echo 222;

}

?>

<div style="float:left; width:200px; padding:10px 0px 10px 0px; border:4px solid #ab9653; color:#5d2d11; border-radius:12px; height:282px; background:#f5ecd0; text-align:center; margin-left:12px;">
<h4>ТЫКВА</h4>
<img src="/img/shop/1.png">
<div style="background:#e7da9a; padding:0px 0px 5px 0px;">
В день: 1.44 <img src="/img/diamon.png" width="30">
</div>
<div style="background:#d8ca86; padding:5px 0px 5px 0px;">
В месяц: <b>45%</b>
</div>
<form action="" method="post">
<input type="hidden" name="item" value="1" />
<input type="submit" value="КУПИТЬ" class="buy" />
</form>
</div>

<div style="float:left; width:200px; padding:10px 0px 10px 0px; border:4px solid #ab9653; color:#5d2d11; border-radius:12px; height:282px; background:#f5ecd0; text-align:center; margin-left:12px;">
<h4>МОРКОВКА</h4>
<img src="/img/shop/2.png">
<div style="background:#e7da9a; padding:0px 0px 5px 0px;">
В день: 4.08 <img src="/img/diamon.png" width="30">
</div>
<div style="background:#d8ca86; padding:5px 0px 5px 0px;">
В месяц: <b>50%</b>
</div>
<form action="" method="post">
<input type="hidden" name="item" value="2" />
<input type="submit" value="КУПИТЬ" class="buy" />
</form>
</div>

<div style="float:left; width:200px; padding:10px 0px 10px 0px; border:4px solid #ab9653; color:#5d2d11; border-radius:12px; height:282px; background:#f5ecd0; text-align:center; margin-left:12px;">
<h4>ПОМИДОРЫ</h4>
<img src="/img/shop/3.png">
<div style="background:#e7da9a; padding:0px 0px 5px 0px;">
В день: 9.12 <img src="/img/diamon.png" width="30">
</div>
<div style="background:#d8ca86; padding:5px 0px 5px 0px;">
В месяц: <b>55%</b>
</div>
<form action="" method="post">
<input type="hidden" name="item" value="3" />
<input type="submit" value="КУПИТЬ" class="buy" />
</form>
</div>

<div class="space2"></div>

<div style="float:left; width:200px; padding:10px 0px 10px 0px; border:4px solid #ab9653; color:#5d2d11; border-radius:12px; height:282px; background:#f5ecd0; text-align:center; margin-left:12px;">
<h4>ФАСОЛЬ</h4>
<img src="/img/shop/4.png">
<div style="background:#e7da9a; padding:0px 0px 5px 0px;">
В день: 30 <img src="/img/diamon.png" width="30">
</div>
<div style="background:#d8ca86; padding:5px 0px 5px 0px;">
В месяц: <b>60%</b>
</div>
<form action="" method="post">
<input type="hidden" name="item" value="4" />
<input type="submit" value="КУПИТЬ" class="buy" />
</form>
</div>

<div style="float:left; width:200px; padding:10px 0px 10px 0px; border:4px solid #ab9653; color:#5d2d11; border-radius:12px; height:282px; background:#f5ecd0; text-align:center; margin-left:12px;">
<h4>КЛУБНИКА</h4>
<img src="/img/shop/5.png">
<div style="background:#e7da9a; padding:0px 0px 5px 0px;">
В день: 54 <img src="/img/diamon.png" width="30">
</div>
<div style="background:#d8ca86; padding:5px 0px 5px 0px;">
В месяц: <b>65%</b>
</div>
<form action="" method="post">
<input type="hidden" name="item" value="5" />
<input type="submit" value="КУПИТЬ" class="buy" />
</form>
</div>

<div style="float:left; width:200px; padding:10px 0px 10px 0px; border:4px solid #ab9653; color:#5d2d11; border-radius:12px; height:282px; background:#f5ecd0; text-align:center; margin-left:12px;">
<h4>ЛИМОН</h4>
<img src="/img/shop/6.png">
<div style="background:#e7da9a; padding:0px 0px 5px 0px;">
В день: 93.12 <img src="/img/diamon.png" width="30">
</div>
<div style="background:#d8ca86; padding:5px 0px 5px 0px;">
В месяц: <b>70%</b>
</div>
<form action="" method="post">
<input type="hidden" name="item" value="6" />
<input type="submit" value="КУПИТЬ" class="buy" />
</form>
</div>			
			
</div>
</div>

<div class="myfarm-menu-right">
<?PHP include("inc/_menu-right.php"); ?>
</div>
</div>
<?PHP include("pages/account/_chat.php"); ?>


