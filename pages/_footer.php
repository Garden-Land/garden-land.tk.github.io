
<?PHP
$tfstats = time() - 60*60*24;
$db->Query("SELECT 
(SELECT COUNT(*) FROM db_users_a) all_users,
(SELECT SUM(insert_sum) FROM db_users_b) all_insert, 
(SELECT SUM(payment_sum) FROM db_users_b) all_payment,
(SELECT COUNT(*) FROM db_users_a WHERE date_reg > '$tfstats') new_users");
$stats_data = $db->FetchArray();
?>
<BR />
<?PHP if(!isset($_GET["menu"]) OR $_GET["menu"] != "adminfoodg"){ ?>
<?PHP } ?>
								
							<div class="clr"></div>	
							</div>
					<div class="clr"></div>
						</div></div>

<div class="footer">				
	<br><br>
	
<br><hr>
		
							
<center><table border="0">
	<tbody><tr>
		<td align="center" width="100">

<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t14.1;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров за 24"+
" часа, посетителей за 24 часа и за сегодня' "+
"border='0' width='88' height='31'><\/a>")
//--></script><a href="//www.liveinternet.ru/click" target="_blank"><img src="//counter.yadro.ru/hit?t14.1;rhttp%3A//skyland.name/index.php;s1366*768*24;uhttp%3A//skyland.name/contacts/%23anchor;0.7939578159712255" alt="" title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня" border="0" width="88" height="31"></a><!--/LiveInternet-->

	
		</td>
		
		<td align="center" width="100"><img src="/img/diz/payeer.png"></td>
		<td align="center" width="100"><img src="/img/diz/freekassa.png"></td>
		</tr>
	<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="4" align="center"><font color="#958b72">Skyland © 2015. Все права защищены.</font></td>
		
	</tr>
<tr>
		<td colspan="4" align="center"><font color="#958b72" size="2">10% от резерва идет на развитие и обслуживание сайта.</font></td>
		
	</tr>
	</tbody></table></center></div>
</html>