<?php
//========== LINKS ALLOWED IN APPLICATION ==========//
$oKonfig['noauths'] = array('login', 'logout', 'locked', 'register');
$oKonfig['link_allowed'] = array(
	'default' => 'zern',
	'index' => '',
	'login' => 'auth', 'locked' => 'auth', 'logout' => 'auth',
	'dashboard' => 'main',
);