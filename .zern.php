<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » index
 * PHP | zern::root ~ indispensable root functions
 **/

/*Disable App when MODE is undefined or set to off*/
if(!defined('oAPP_MODE') || oAPP_MODE == '' || oAPP_MODE == 'off'){exit;}

//========== SEPARATOR ==========//
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('PS') ? null : define('PS', '/');


//========== CONFIG ==========//
function zernConfig($config='oCONFIG'){
	if($config == 'oCONFIG'){
		global $oConfig;
		if(!empty($oConfig) && is_array($oConfig)){$config = $oConfig;}
	}

	if(!empty($config) && is_array($config)){
		return $config;
	}
}


//========== IP VALIDATOR [returns true/false] ==========//
function zernValIP($host=''){
	if(!empty($host)){
		$parts = parse_url($host);
		if(!isset($parts['host'])){$eval = (bool)ip2long($host);}
		else {$eval = (bool)ip2long($parts['host']);}
		return $eval;
	}
	return false;
}


//========== ROOT (Directory & URL) ==========//
function zernBP($task = 'oDIR', $path=''){
	$eval = '';
	if($task == 'oHOST'){
		if(!empty($_SERVER["SERVER_NAME"])){
			$eval = $_SERVER["SERVER_NAME"];
			$config = zernConfig();
			if((zernValIP($eval) || $eval == 'localhost') && !empty($config['ifip'])){
				$eval = $eval.PS.$config['ifip'];
			}
		}
	}
	elseif($task == 'oDIR'){
		if(!empty($path)){
			$pathinfo = pathinfo($path);
			$eval = $pathinfo['dirname'].DS;
		}
		elseif(!empty($_SERVER["DOCUMENT_ROOT"])){
			$eval = $_SERVER["DOCUMENT_ROOT"].DS;
		}
	}
	return $eval;
}


//========== FILE LOADER (only add files) ==========//
function zernLoad($file='', $as='oREQUIRED'){
	if(!empty($file) && !is_file($file)){$file = $file.'.php';}
	if(file_exists($file)){require $file;}
	elseif($as == 'oREQUIRED'){
		if(!defined('oAPP_MODE') || oAPP_MODE != 'dev'){
			exit('ZE404: '.basename($file));
		}
		else {
			exit('Missing Library: '.$file);
		}
	}
}
?>