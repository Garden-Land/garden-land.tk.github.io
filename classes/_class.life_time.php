
<?PHP

class life_time
{


	function __construct($db)
	{
		$this->db = $db;
	}


	private function GetTimeLife($name)
	{
		switch ($name) 
		{
			case 'a_t':
				return 60*60*24*60;
			break;

			case 'b_t':
				return 60*60*24*60;
			break;
			
			case 'c_t':
				return 60*60*24*60;
			break;

			case 'd_t':
				return 60*60*24*60;
			break;

			case 'e_t':
				return 60*60*24*60;
			break;
			
			case 'f_t':
				return 60*60*24*60;
			break;

			default:
				return 60*60*24*30;
			break;
		}
	}


	private function GetNameItem($name)
	{
		switch ($name) 
		{
			case 'a_t':
				return "<img src='/img/build/1.png' width='200'>";
			break;

			case 'b_t':
				return "<img src='/img/build/2.png' width='200'>";
			break;

			case 'c_t':
				return "<img src='/img/build/3.png' width='200'>";
			break;
			
			case 'd_t':
				return "<img src='/img/build/4.png' width='200'>";
			break;

			case 'e_t':
				return "<img src='/img/build/5.png' width='200'>";
			break;

			case 'f_t':
				return "<img src='/img/build/6.png' width='200'>";
			break;

			default:
				return $name;
			break;
		}
	}


		public function AddItem($user_id, $name, $time=0)
	{
		$db = $this->db;
		$now = time();
		if ($time==0) $del = $now + $this->GetTimeLife($name);
		else
			$del = $now + $time;
		$sql = "insert into `db_product_time`
				(`id_user`, `name`, `date_add`, `date_del`, `status`)
				values
				($user_id, '$name', $now, $del, 1)";
		$db->Query($sql);
		return ($db->LastInsert()>0);
	}


	public function CheckTime()
	{
		$db = $this->db;
		$now = time();
		$sql = "select * from `db_product_time` where `status`=1 and `date_del`<=$now";
		$db->Query($sql);
		$arr = array();
		if ($db->NumRows()>0)
		{
			while($row = $db->FetchArray())
			{
				$arr[] = $row;
			}
		}
		if (count($arr)>0)
		{
			foreach ($arr as $row)
			{
				$id = $row['id'];
				$par = $row['name'];
				$user = $row['id_user'];
				$sql = "update `db_users_b` set `$par`=`$par`-1 where `id`=$user";
				$db->Query($sql);
				$sql = "update `db_product_time` set  `status`=0 where `id`=$id";
				$db->Query($sql);
			}
		}
	}

	private function ConvertTime($val)
	{
		$time = (int)$val;
		$m = floor($time / 60);
		$h = floor($m / 60);
		$d = floor($h / 24);
		
		$m = $m - $h*60;
		$s = $time - $m*60 - $h*60*60;
		
		$hh = $h - $d*24;
	    
	  
	   if($d != 0) return "$d дн $hh ч $m мин $s сек";
	   if($h != 0) return "$h ч $m мин $s сек";
	   if($m != 0) return "$m мин $s сек";
	   if($s != 0) return "$s сек";

	}


	public function GetTable($user_id)
	{
		$style = "<style>.info_block{float:left; text-align:center; margin: 0px 20px 20px 0px;width: 230px;border-radius: 20px;} .info_block div{padding: 15px;}</style>";
		$db = $this->db;
		echo $style;
		$sql = "select * from `db_product_time` where `status`=1 and `id_user`=$user_id";
		$db->Query($sql);
		while($row = $db->FetchArray()) 
		{
			$tim = (int)$row['date_del']-time();
			$tim = $this->ConvertTime($tim);
			echo "<div class='info_block'>";
				echo "<div>";
				echo $this->GetNameItem($row['name'])." </br><b>до разрушения этажа:</b></br> ".$tim;
				echo "</div>";
			echo "</div>";
		}
	}

}