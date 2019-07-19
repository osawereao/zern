<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » ~
 * PHP | index::root ~ default file
 **/

//========== PROJECT CONFIGURATION -R ==========//
define('oAPP_MODE', 'dev'); #[DEV|BETA|PROD|OFF|MAINTENANCE] -R
$oConfig = array();
$oConfig['project'] = 'ZenQ';
$oConfig['ver'] = '1.0';
$oConfig['ifip'] = 'zern'; #path to app via IP
$oConfig['url'] = 'zern.co'; #base URL to app


//========== ZERN PATH & LIBRARY ==========//
if(file_exists('.zern.php')){
	require '.zern.php';
	$zernDIR = zernBP('oDIR', __FILE__);
	$zernURL = zernBP('oHOST');
	define('zernDIR', $zernDIR);
	define('zernURL', $zernURL);
	$zertInit = zernDIR.'zern'.DS.'init.php';
	if(file_exists($zertInit)){
		require $zertInit;
		if((!defined('oPROJECT') || oPROJECT == '') || !file_exists(oPROJECT.'ignite.php')){
			exit('ZE404B: Missing Ignition');
		}
		require oPROJECT.'ignite.php';
	}
	elseif(!defined('oAPP_MODE') || oAPP_MODE == '' || oAPP_MODE == 'dev'){
		exit("ZE404B: Zern Initializer [{$zertInit}]");
	}
}
elseif(!defined('oAPP_MODE') || oAPP_MODE == '' || oAPP_MODE == 'dev'){
	exit('ZE404A: Zern Root [.zern.php]');
}
?>