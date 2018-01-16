<?PHP

class webmoney{


	function wmid($purse){
	
		$content = file_get_contents("https://passport.webmoney.ru/asp/certview.asp?purse=".$purse);
		$content_first = explode('/Levels/pWMIDLevel.aspx?wmid=', $content);
		$content_secont = explode('&', $content_first[1]);
		return ( strlen($content_secont[0]) == 12) ? $content_secont[0] : false;
	
	}

}
?>