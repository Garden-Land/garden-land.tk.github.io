<?PHP

class competition{

	var $db = NULL;
	var $compd = array();
	
	
	# �����������
	function __construct($db){
	
		$this->db = $db;
		$this->compd = $this->CompData();
		
	}
	
	# ������ ��������
	function CompData(){
	
		$this->db->Query("SELECT * FROM db_competition WHERE status = '0' LIMIT 1");	
		if($this->db->NumRows() > 0){
			
			return $this->db->FetchArray();

				
		}else return false;
	}
	
	# ��������� ���� ������������
	function UpdatePoints($user_id, $sum){
	
		$user_id = intval($user_id);
		$sum = round($sum, 2);
		
		if($this->compd["date_add"] >= 0 AND $this->compd["date_end"] > time()){
		
			$this->db->Query("SELECT referer, referer_id, date_reg FROM db_users_a WHERE id = '{$user_id}'");
			$ret_d = $this->db->FetchArray();
			
			if($ret_d["date_reg"] >= $this->compd["date_add"]){
			
				# ��������� ���� �� ������������ � ��������
				$ref_id = $ret_d["referer_id"];
				$ref = $ret_d["referer"];
				$this->db->Query("SELECT COUNT(*) FROM db_competition_users WHERE user_id = '{$ref_id}'");
				if($this->db->FetchRow() == 1){
				
					$this->db->Query("UPDATE db_competition_users SET points = points + '{$sum}' WHERE user_id = '{$ref_id}'");
				
				}else $this->db->Query("INSERT INTO db_competition_users (user, user_id, points) VALUES ('{$ref}','{$ref_id}','$sum')");
				
				return true;
				
			}else return false;
			
		}else return false;
		
	}
	
}



?>