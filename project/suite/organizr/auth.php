<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » *
 * PHP | auth::organizr ~ authentication [login, logout, locked, etc]
 **/

$auth = array();


//========== LOGIN ==========//
if($zern->oLink == 'login'){
	$oprocez = 'oNOPE';

	if($zernRoute == 'api'){
		$omethod = 'oGET'; #$omethod = 'oREQUEST';
		$oprocez = 'oYEAP';
	}
	elseif($zernRoute == 'app'){
		$omethod = 'oPOST';
		if(empty($_POST)){
			oSession::restart();
			if(empty($_GET['zern'])){$auth ['oCODE'] = 'E100A1';}
			else {
				if($_GET['zern'] == 'logout'){$auth['oCODE'] = 'E200A2';}
			}
		}
		else {
			$oprocez = 'oYEAP';
		}
	}


	/*** PROCESS Login ***/
	if($oprocez == 'oYEAP'){
		$fita = array('userid', 'password');
		$input = oInput::prep($omethod, $fita);
		if(empty($input)){$auth['oCODE'] = 'E400A1';}
		elseif(empty($input['userid'])){$auth['oCODE'] = 'E400A2';}
		elseif(empty($input['password'])){$auth['oCODE'] = 'E400A3';}
		else {
			$input['userid'] = strtolower($input['userid']);
			$auth = $zern->Auth->login($input['userid'], $input['password']);
			if($auth['oCODE'] == 'E200A1' && $zernRoute == 'app'){
				$zernApp->redirect($zern->oURL.PS.'dashboard');
			}
		}
	} /*** PROCESS Login ~End ***/

}
//========== LOGIN ~end ==========//




//========== UI LOADING [if module is not empty and router is app] ==========//
if(!empty($auth)){
	$auth = oKit::response($auth, $zern->oLink);
	if($zernRoute == 'app'){require oDESIGN.'auth.php';}
}






ZERN::dbug($auth);
?>