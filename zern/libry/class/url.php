<?php
class oURL {
	private static $instance;

	//-------------- Prevent multiple instances ---------------
	private function __construct(){return;}

	//-------------- Prevent duplication ---------------
	private function __clone(){return;}

	//-------------- Returns a single instance ---------------
	public static function instantiate(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}





/**
 * ===================================================================
 *  [BEGIN] DEVELOPER
 * ===================================================================
 */

	public static function isIP($host='oGET'){
		if($host=='oGET'){$host = $_SERVER['HTTP_HOST'];}
		if(!empty($host)){
			$parts = parse_url($host);
			if(isset($parts['host'])){
				$isIP = (bool)ip2long($parts['host']);
			} else {
				$isIP = (bool)ip2long($host);
			}
			if($isIP === true){return 'yeap';}
		}
		return 'nope';
	}

	public static function route($route=''){
		if(empty($route)){
			if(self::isIP() == 'yeap'){$route = 'ipaddress';}
			elseif(isset($_GET['route'])){$route = $_GET['route'];}
		}
		if(empty($route)){$route = 'site';}
		return strtolower($route);
	}

	public static function uri($uri=''){
		if(empty($uri) && isset($_GET['uri'])){$uri = $_GET['uri'];}
		if(empty($uri)){$uri = 'index';}
		$uri = rtrim($uri, '/');
		if(oText::in($uri, '/')){
			$uri = oText::swap($uri, '/', '.', 'oFIRST');
			if(oText::in($uri, '/')){$uri = oText::swap($uri, '/', '_', 'oALL');}
		}
		// if(oText::in($uri, '_')){$uri = oText::swap($uri, '_', '-');}
		return strtolower($uri);
	}

	public static function uriData($uri='', $return='oALL'){
		#NOTE: by design, if $uri === index, $action & $case can only be default [nothing else]
		if(empty($uri)){$uri = self::uri();}
		$isURI = $uri;
		$link = $isURI;
		$action = 'default';
		$case = 'default';

		#Case
		if(oText::in($isURI, '_')){
			$countMarkerCase = substr_count($isURI, '_');
			if($countMarkerCase > 1){
				$isCase = oText::swap($isURI, '_', '||CASEMARKER||', 'oFIRST');
				$isCase = oText::swap($isCase, '_', '-');
				$isCase = oText::swap($isCase, '||CASEMARKER||', '_');
			}
			if(!empty($isCase)){$isCase = oText::after($isCase, '_', 'oYEAP');}
			else {$isCase = oText::after($isURI, '_', 'oYEAP');}

			if(!empty($isCase)){
				if(oText::in($isCase, '_')){$isCase = oText::swap($isCase, '_', '-');}
				$case = $isCase;
				$isURI = oText::swap($isURI, '_'.$isCase, '');
			}
		}

		#Link
		if(oText::in($isURI, '.')){
			$isLink = oText::before($isURI, '.', 'oYEAP');
			if(!empty($isLink)){
				$link = $isLink;
				$isURI = oText::swap($isURI, $isLink.'.', '');
			}
		}

		#Action
		$isAction = $uri;
		//Remove link from $action, then remove $case
		if(oText::in($uri, '.')){$action = oText::swap($isAction, $link.'.', '');}
		else {$action = oText::swap($isAction, $link, '');}
		if($isURI != $link){
			$action = $isURI;
			if(oText::in($action, '_')){
				$action = oText::before($action, '_', 'oYEAP');
			}
		}
		if(empty($action)){$action = 'default';}

		$uriData['case'] = $case;
		$uriData['action'] = $action;
		$uriData['link'] = $link;
		$uriData['uri'] = $uri;

		if($return == 'oCASE'){return $uriData['case'];}
		elseif($return == 'oACTION'){return $uriData['action'];}
		elseif($return == 'oLINK'){return $uriData['link'];}
		elseif($return == 'oURI'){return $uriData['uri'];}
		else {return $uriData;}
	}

	//-------------- URL redirect ---------------
	public static function redirect($dest='', $delay=0){
		if(empty($dest)){return false;}
		else {
			if(headers_sent($filename, $linenum)){
				$task = '<meta http-equiv="refresh" content="'.$delay.'; url='.$dest.'">';
				echo $task;
				if($delay == 0){exit;}
			}
			elseif($delay == 0){
				header('Location: '.$dest);
				exit;
			}
			else {
				header("Refresh:".$delay.";URL=".$dest);
			}
		}
	}

//-------------- Clean up a URL & return domain ---------------
	public static function url2domain($url){
		$domain = $url;
		$domain = oText::swap($domain, 'https://', '', 'first');
		$domain = oText::swap($domain, 'http://', '', 'first');

		#remove sub-directory if available
		if(self::in($domain, '/')){
			$domain = self::before($domain, '/', 'yeah');
		}

		#remove [known] sub-domain *ToDO [use library]
		$domain = oText::swap($domain, 'www.', '', 'first');
		$domain = oText::swap($domain, 'en.', '', 'first');
		$domain = oText::swap($domain, 'ng.', '', 'first');

		return $domain;
	}

} // END URL CLASS
?>