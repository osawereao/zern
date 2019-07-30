<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » index/zern
 * PHP | app::route ~ run app
 **/

if(isset($zern->Auth)){
	$noauthLinks = array('login', 'logout', 'locked');
	if(!in_array($zern->oLink, $noauthLinks)){
		$zern->Auth->is();
	}
	// $zernAuth->timeOut('locked', 5000);
	// require oUTIL.'auth.php';
// require $zern->router();
$zern->Auth->timeIn();
}

echo '<p>'.$zern->router().'</p>';
?>