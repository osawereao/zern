<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » ~
 * PHP | kit::class ~ utility class
 **/

class oKit {

	//========== HAS SSL [detect HTTPS & Return true or false] ==========//
	public static function hasSSL($answer='detect'){
		$resolve = false;
		if($answer == 'oYEAP'){$resolve = true;}
		elseif($answer == 'oNOPE'){$resolve = false;}
		else {//detect from server
			$https = 'oNOHTTPS';
			if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])){$https = $_SERVER['HTTPS'];}
			if($https !== 'oNOHTTPS'){$https == 'oHTTPS';}

			$port = 'oDEFAULT';
			if(isset($_SERVER['SERVER_PORT']) && !empty($_SERVER['SERVER_PORT'])){$port = $_SERVER['SERVER_PORT'];}

			if($https == 'oHTTPS' || $port == 443){$resolve = true;}
			elseif(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'oHTTPS'){$resolve = true;}
		}
		return $resolve;
	}
	//========== HAS SSL ~end ==========//



	//========== SSL ENFORCER [force URL to run HTTPS] ==========//
	public static function imposeSSL($permanent='oNOPE'){
		if(empty($_SESSION['imposeSSL'])){
			$protocol = self::hasSSL() ? 'https' : 'http';
			if($protocol != 'https'){
				$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$_SESSION['imposeSSL'] = 'oYEAP';
				if($permanent == 'oYEAP'){header('HTTP/1.1 301 Moved Permanently');}
				oURL::redirect($url);
				exit;
			}
		}
	}
	//========== SSL ENFORCER ~end ==========//



	//========== ERROR HANDLER [prepare & process] ==========//
	public static function isError($code, $source='', $return='oMSG'){
		global $oErrorConfig;
		if(!empty($oErrorConfig) && !empty($oErrorConfig[$source]) && is_array($oErrorConfig[$source])){
			$error = $oErrorConfig[$source];
			if($return == 'oMSG' && array_key_exists($code, $error)){return $error[$code];}
		}
		return '';
	}
	//========== ERROR HANDLER ~end ==========//



	//========== RESPONSE [prepare & return] ==========//
	public static function response($resp='', $source=''){
		$o['oSTATUS'] = ''; $o['oCODE'] = ''; $o['oMSG'] =''; $o['oDATA'] = '';
		if(!empty($resp['oSTATUS'])){$o['oSTATUS'] = $resp['oSTATUS'];}
		if(!empty($resp['oCODE'])){
			$o['oCODE'] = $resp['oCODE'];
			$resp['oMSG'] = self::isError($o['oCODE'], $source);
		}
		if(!empty($resp['oMSG'])){$o['oMSG'] = $resp['oMSG'];}
		if(!empty($resp['oDATA'])){$o['oDATA'] = $resp['oDATA'];}
		return $o;
	}
	//========== RESPONSE ~end ==========//




	//========== JSON [output content in json format] ==========//
	public static function jsonResp($data){
		if(!empty($data)){
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	//========== JSON ~end ==========//


}


//-------------- Check if variable is actually empty ---------------
function isEmpty($data=''){
	if(!isset($data)){return true;}
	else {
		if(is_array($data)){
			if(empty($data)){return true;}
		} else {
			$data = trim($data);
			$length = strlen($data);
			if($length<1){return true;}
		}
	}

	return false;
}


//-------------- Check if array is multi-dimensional ---------------
function isArrayMulti($data){
	if(is_array($data)){
		$result = array_filter($data,'is_array');
		if(count($result)>0) return true;
	}
	#return (count($array) != count($array, 1)); # ~ confirm what this code does, it maybe a replacement for the above

	return false;
}


//-------------- Check PHP version ---------------
function isPHP($process='version'){
	$result = 'e204';
	if($process=='version'){$result = phpversion();}

	if(isset($result)){return $result;}
}


//-------------- Check Apache version ---------------
function isApache($process='version'){
	$result = 'e204';
	if($process=='version'){$result = apache_get_version();}

	if(isset($result)){return $result;}
}







//-------------- Print output ---------------
function printInfo($info, $ifEmpty=''){
	if(!empty($info)){echo $info;}
	else {echo $ifEmpty;}
}


//-------------- Process error ---------------



//-------------- Out message ---------------
function printMsg($data='', $process='export'){
	if($process=='export'){
		echo '<tt><pre>'.var_export($data,TRUE).'</pre></tt>';
		return;
	}
}

//-------------- Prepare isError & other response ---------------


//-------------- Debugging ---------------



function lang($lang=''){
	if(empty($lang)){
		if(!empty($_GET['lang'])){$_SESSION['lang'] = $_GET['lang'];}
		if(empty($_SESSION['lang'])){$_SESSION['lang'] = 'en';}
		$lang = $_SESSION['lang'];
	}
	return $lang;
}




function formatNum($num='', $digit=2){
	if(is_numeric($num)){
		if($digit == 2){return number_format($num, 2);}
		else {return number_format($num);}
	}
	else {
		return $num;
	}
}

function formatSize($size=''){
	if(is_empty($size)){return FALSE;}
	if($size>=1073741824){$format = number_format($size / 1073741824 , 2) . 'GB';}
	elseif($size>=1048576){$format = number_format($size / 1048576 , 2) . 'MB';}
	elseif($size>=1024){$format = number_format($size / 1024 , 2) . 'KB';}
	elseif($size>1){$format = $size . ' bytes';}
	elseif($size==1){$format = $size . ' byte';}
	else {$format = '0';}
	return $format;
}

function currencyToSymbol($currency=''){
	$currency = strtolower($currency); $symbol = '';
	if($currency == 'dollar'){$symbol = '$';}
	if($currency == 'pound'){$symbol = '£';}
	if($currency == 'euro'){$symbol = '€';}
	if($currency == 'yen'){$symbol = '¥';}
	if($currency == 'rupee'){$symbol = '₹';}
	if($currency == 'naira'){$symbol = '₦';}
	return $symbol;
}

function formatAmount($amount, $currency='naira', $digit=''){
	if(!isEmpty($currency) && !isEmpty($amount)){
		$symbol = currencyToSymbol($currency);
		$amount = formatNum($amount, $digit);
		return $symbol.$amount;
	}
}



?>
