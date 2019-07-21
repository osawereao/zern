<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » index/zern
 * PHP | app::route ~ run app
 */

if(isset($zern->Auth)){
	$noauthLinks = array('login', 'logout', 'locked');
	if(!in_array($zern->oLink, $noauthLinks)){
		#$zern->Auth->is();

		}
	// $zernAuth->timeOut('locked', 5000);
	// require oUTIL.'auth.php';
// require $zernApp->router();
// $zernAuth->timeIn();

// $input['status'] = 2;

// $input['dept'] = 'APP';

$username = 'dev8';
$input['Username'] = oAuth::ocrypt($username, 'oEN64');
$input['Email'] = oAuth::ocrypt($username.'@zenq.ca', 'oEN64');
$input['Phone'] = '09026636728';
$input['Password'] = oAuth::password('oDev8#');
$input['PIN'] = 1314;
$input['Type'] = oAuth::ocrypt('software', 'oENCODE');
$input['Privilege'] = 20;

$input['LastName'] = oAuth::ocrypt('Osawere', 'oENCODE');
$input['FirstName'] = oAuth::ocrypt('Anthony', 'oENCODE');
$input['OtherName'] = oAuth::ocrypt('ODAO', 'oENCODE');

$input['DOB'] = oPeriod::create('October 31, 1987','oMYSQLDATE');
$input['Sex'] = 'M';
$input['LGA'] = 'Oredo';
$input['State'] = 'Edo';
$input['Country'] = 'NG';

$input['ReferralID'] = 'Dev8';
$input['ReferrerID'] = 'SELF';

$Insert = $zern->DB->createSQL('oUSER_TABLE', $input);
// $Trash = $zern->DB->expunge('oUSER_TABLE');

// ZERN::dbug($Trash);


// global $zernApp;
// function CreateUser(){
// 	#user data
	

// 	#insert the record
// 	global $zernDB;
// 	$insert = $zernDB->insert('userx', $input);

// 	#dbug the result
// 	dbug($insert);
// 	die;
// }
// #CreateUser();

}
echo '<br>'.$zern->oLink;
?>