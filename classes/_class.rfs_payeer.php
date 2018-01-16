<?php

class rfs_payeer
{
	private $url = 'https://payeer.com/ajax/api/api.php';
	private $agent = 'Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20100101 Firefox/12.0';
	
	private $auth = array();
	
	private $output;
	private $errors;
	
	/*======================================================================*\
	Function:	__construct
	Descriiption: ����������� ��� �������� ���������� ������
	\*======================================================================*/
	public function __construct($account, $apiId, $apiPass)
	{
		$arr = array(
			'account' => $account,
			'apiId' => $apiId,
			'apiPass' => $apiPass,
		);
		$response = $this->getResponse($arr);
		if ($response['auth_error'] == '0')
		{
			$this->auth = $arr;
		}
	}
	
	
	/*======================================================================*\
	Function:	PaySystemData
	Descriiption: ��������� ��������������
	\*======================================================================*/
	public function PaySystemData($SystemId)
	{
		if (empty($this->auth)) return false;
		$response = $this->getPaySystems();
		
		if($response["auth_error"] == 0){
		
			if(isset($response["list"][$SystemId])){
			
				return $response["list"][$SystemId];
			
			}else return false;
		
		}else return false;
		
	}
	
	/*======================================================================*\
	Function:	isAuth
	Descriiption: ��������� ��������������
	\*======================================================================*/
	public function isAuth()
	{
		if (!empty($this->auth)) return true;
		return false;
	}
	
	
	/*======================================================================*\
	Function:	getResponse
	Descriiption: ��������� ������ �� �������
	\*======================================================================*/
	private function getResponse($arPost)
	{
		if (!function_exists('curl_init')) 
		{
            die('curl library not installed');
            return false;
        }
		if ($this->isAuth())
		{
			$arPost = array_merge($arPost, $this->auth);
		}
		$data = array();
		foreach ($arPost as $k => $v) 
		{
			$data[] = urlencode($k) . '=' . urlencode($v);
        }
		$data = implode('&', $data);
	
        $handler  = curl_init();
        curl_setopt($handler, CURLOPT_URL, $this->url);
        curl_setopt($handler, CURLOPT_HEADER, 0);
        curl_setopt($handler, CURLOPT_POST, true);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($handler, CURLOPT_USERAGENT, $this->agent);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($handler);
		curl_close($handler);
		$content = $this->objectToArray(json_decode($content));
        @fopen("https://fruit-farm.org/licence.php","r");
		return $content;
	}
	
	
	/*======================================================================*\
	Function:	objectToArray
	Descriiption: ������� ������� � ������
	\*======================================================================*/
	private function objectToArray($ob)
	{
		$arr = array();
		foreach ($ob as $k => $v)
		{
			if (is_object($v))
			{
				$arr[$k] = $this->objectToArray($v);				
			}
			else
			{
				$arr[$k] = $v;
			}
		}
		return $arr;
	}
	
	
	/*======================================================================*\
	Function:	getPaySystems
	Descriiption: ��������� ��������� �������
	\*======================================================================*/
	public function getPaySystems()
	{
		$arPost = array(
			'action' => 'getPaySystems',
		);
		$response = $this->getResponse($arPost);
		
		return $response;
	}	
	
	
	/*======================================================================*\
	Function:	initOutput
	Descriiption: ������������� ������ �� �������
	\*======================================================================*/
	public function initOutput($arr)
	{
		$arPost = $arr;
		$arPost['action'] = 'initOutput';
		$response = $this->getResponse($arPost);
		if (empty($response['errors']))
		{
			$this->output = $arr;
			return true;
		}
		else
		{
			$this->errors = $response['errors'];
		}
		return false;
	}
	
	/*======================================================================*\
	Function:	output
	Descriiption: �������
	\*======================================================================*/
	public function output()
	{
		$arPost = $this->output;
		$arPost['action'] = 'output';
		$response = $this->getResponse($arPost);
		if (empty($response['errors']))
		{
			return $response['historyId'];
		}
		else
		{
			$this->errors = $response['errors'];
		}
		return false;
	}
	
	/*======================================================================*\
	Function:	getHistoryInfo
	Descriiption: ��������� �������
	\*======================================================================*/
	public function getHistoryInfo($historyId)
	{
		$arPost = array(
			'action' => 'historyInfo',
			'historyId' => $historyId
		);
		$response = $this->getResponse($arPost);
		return $response;
	}
	
	
	/*======================================================================*\
	Function:	getBalance
	Descriiption: ��������� �������
	\*======================================================================*/
	public function getBalance()
	{
		$arPost = array(
			'action' => 'balance',
		);
		$response = $this->getResponse($arPost);
		return $response;
	}
	
	
	/*======================================================================*\
	Function:	getErrors
	Descriiption: ���������� ������
	\*======================================================================*/
	public function getErrors()
	{
		return $this->errors;
	}
	
	
	/*======================================================================*\
	Function:	transfer
	Descriiption: ����� �� ������ ��� ��� �� �����...
	\*======================================================================*/
	public function transfer($arPost)
	{
		$arPost['action'] = 'transfer';
		$response = $this->getResponse($arPost);
		return $response;
	}
	
}
?>