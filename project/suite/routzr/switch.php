<?php

/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » index/zern
 * PHP | switch::route ~ run app
 **/

if (!empty($zern->oRoute)) {
	$zernRoute = $zern->oRoute;
	if ($zernRoute == 'ipaddress') {
		$zernRoute = 'app';
	}
	$zernAuth = $zern->Auth;
	if ($zernRoute == 'app') {
		$noauths = array('login', 'logout', 'locked', 'register');
		if (!in_array($zern->oLink, $noauths)) {
			$zern->Auth->is();
			#$zern->Auth->timeOut('locked', 500);
		}
	}
	if ($zernRoute != 'site') {
		require oUTIL . 'auth.php';
		require $zern->router();
	} else {
		require oDESIGN . 'site.php';
	}
	$zern->Auth->timeIn();
}
?>