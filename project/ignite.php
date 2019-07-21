<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » index/zern
 * PHP | ignite::project ~ load required library, and ignite app
 **/

//========== LOAD LIBRARY (as needed in project) ==========//
#inc(oLIBJ.'file');
ZERN::inc(oLIBJ.'pdo');
ZERN::inc(oLIBJ.'crypt');
ZERN::inc(oLIBJ.'auth');
ZERN::inc(oLIBJ.'input');
ZERN::inc(oLIBJ.'data');
ZERN::inc(oLIBJ.'img');
ZERN::inc(oLIBZ.'dbo');


//========== INITIALIZE & RUN APP ==========//
if(!empty($zern)){
	$zern->initApp();

	/*** ROUTE everything to APP [specific to this application] ***/
	// if($zern->oRoute == 'site' || $zern->oRoute == 'ipaddress'){$zern->oRoute = 'app';}
	if($zern->oRoute != 'app'){$zern->oRoute = 'app';}

	$routzr = oROUT.$zern->oRoute.'.php';
	if(file_exists($routzr)){require $routzr;}
	elseif(defined('oAPPMODE') && oAPPMODE == 'DEV'){
		exit("ZE4041: Missing [{$routzr}]");
	}
	else {
		exit('ZE4042: Missing Router');
	}
}
?>