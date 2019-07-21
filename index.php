<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » ~
 * PHP | index::root ~ default file
 **/

//========== ZERN PATH & LIBRARY, CONFIG ==========//
$initKF = 'project/config/init.php';
if(!file_exists($initKF)){
	exit('ZE404A: CONFIG REQUIRED');
}
else {
	require $initKF;
	if(file_exists('.zern.php')){
		require '.zern.php';
		$zern = new ZERN;
		$zern->init();
		$zern->setBP('oDIR', __FILE__);
		$zern->setBP('oHOST', 'oPREP');
		define('zernDIR', $zern->oDir);
		define('zernHOST', $zern->oHost);
		$initZF = $zern->oDir.'zern'.DS.'init.php';
		if(!file_exists($initZF)){
			if(!defined('oAPPMODE') || oAPPMODE == '' || oAPPMODE == 'DEV'){
				exit("ZE404B: ZERN INIT [{$initZF}]");
			} else {
				exit("ZE404B");
			}
		}
		else {
			require $initZF;
			if((!defined('oPROJECT') || oPROJECT == '') || !file_exists(oPROJECT.'ignite.php')){
				exit('ZE404C: PROJECT IGNITION');
			}
			require oPROJECT.'ignite.php';
		}
	}
	elseif(!defined('oAPPMODE') || oAPPMODE == '' || oAPPMODE == 'DEV'){
		exit('ZE404B: ZERN REQUIRED [.zern.php]');
	}
}
?>