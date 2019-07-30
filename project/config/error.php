<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » *
 * PHP | error::konfig ~ error messages & codes
 **/

$oErrorConfig = array();

/*** LOGIN ***/
$oErrorConfig['login'] = array(
	'E100A1' => 'Please enter your login details',

	'E200A1' => 'Login successful',
	'E200A2' => 'You have logged out successfully',

	'E400A1' => 'Your UserID and password are required',
	'E400A2' => 'Your UserID is required',
	'E400A3' => 'Your password is required',

	'E401A1' => 'Your password is incorrect',

	'E404A1' => 'User account was not found!', #[oNORECORD]

	'E501A1' => 'A program error occurred',

	'E600B2' => 'Login failed', #query[oERROR]
	'E600B3' => 'Operation failed', #query[false]
);

?>