<?php
/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » ~
 * PHP | setup::zern ~ paths, core library
 **/

//========== DIRECTOR STRUCTURE [directory path] ==========//
# Define ENGINE DS
defined('oENGINE') ? null : define('oENGINE', zernDIR.'zern'.DS);
defined('oBOND') ? null : define('oBOND', oENGINE.'bond'.DS);
defined('oLIBRY') ? null : define('oLIBRY', oENGINE.'libry'.DS);
defined('oLIBCLAS') ? null : define('oLIBCLAS', oLIBRY.'class'.DS);
defined('oLIBFUNC') ? null : define('oLIBFUNC', oLIBRY.'func'.DS);
defined('oLIBJ') ? null : define('oLIBJ', oLIBRY.'object'.DS);
defined('oLIBZ') ? null : define('oLIBZ', oLIBRY.'zaid'.DS);


# Define PROJECT DS
defined('oPROJECT') ? null : define('oPROJECT', zernDIR.'project'.DS);
defined('oDRIVE') ? null : define('oDRIVE', oPROJECT.'drive'.DS);
defined('oCONFIG') ? null : define('oCONFIG', oPROJECT.'config'.DS);

defined('oSUITE') ? null : define('oSUITE', oPROJECT.'suite'.DS);
defined('oAPI') ? null : define('oAPI', oSUITE.'api'.DS);
defined('oMODEL') ? null : define('oMODEL', oSUITE.'modelizr'.DS);
defined('oRGANIZ') ? null : define('oRGANIZ', oSUITE.'organizr'.DS);
defined('oROUT') ? null : define('oROUT', oSUITE.'routzr'.DS);
defined('oUTIL') ? null : define('oUTIL', oSUITE.'utilizr'.DS);

defined('oINTERFACE') ? null : define('oINTERFACE', oPROJECT.'interface'.DS);
defined('oDESIGN') ? null : define('oDESIGN', oINTERFACE.'design'.DS);
defined('oLAYOUT') ? null : define('oLAYOUT', oINTERFACE.'layout'.DS);
defined('oBIT') ? null : define('oBIT', oLAYOUT.'bitzr'.DS);
defined('oFORM') ? null : define('oFORM', oLAYOUT.'formzr'.DS);
defined('oSLICE') ? null : define('oSLICE', oLAYOUT.'slicezr'.DS);
defined('oVIEW') ? null : define('oVIEW', oLAYOUT.'viewzr'.DS);


# Using HTACCESS for PATH
defined('CLOUD') ? null : define('CLOUD', 'cloud'.PS);
defined('ASSET') ? null : define('ASSET', 'asset'.PS);
defined('CSS') ? null : define('CSS', 'css'.PS);
defined('ICON') ? null : define('ICON', 'icon'.PS);
defined('JS') ? null : define('JS', 'js'.PS);
defined('MEDIA') ? null : define('MEDIA', 'media'.PS);
defined('PLUGIN') ? null : define('PLUGIN', 'plugin' . PS);
defined('AUDIO') ? null : define('AUDIO', 'audio'.PS);
defined('DOCUMENT') ? null : define('DOCUMENT', 'document'.PS);
defined('GRAFIX') ? null : define('GRAFIX', 'grafix'.PS);
defined('IMAGE') ? null : define('IMAGE', 'image'.PS);
defined('VIDEO') ? null : define('VIDEO', 'video'.PS);
defined('FONT') ? null : define('FONT', 'font' . PS);


//========== LIBRARY ==========//
require oCONFIG.'db.php';
require oCONFIG.'link.php';
require oCONFIG.'error.php';
ZERN::inc(oLIBCLAS.'session');
ZERN::inc(oLIBCLAS.'kit');
ZERN::inc(oLIBCLAS.'text');
ZERN::inc(oLIBCLAS.'url');
ZERN::inc(oLIBCLAS.'period');
ZERN::inc(oLIBFUNC.'randomiz');
ZERN::inc(oLIBZ.'html');
// ZERN::inc(oLIBRY.'zern');
?>