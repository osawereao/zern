<?php

/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » ~
 * PHP | .zern::FW ~ the framework's main class
 **/

class ZERN
{
	//==========** CONSTRUCT **==========//
	public function __construct($konfig = '')
	{
		$this->konfig($konfig);
		$this->init();
		return;
	}


	//==========** ZONE [set timezone] **==========//
	private function zone($zone = 'oZERN')
	{
		#TODO ~ validate timezone's input
		if ($zone == 'oZERN') {
			$zone = 'Africa/Lagos';
		}
		date_default_timezone_set($zone);
		if (!empty($zone)) {
			$this->zone = $zone;
		}
	}


	//==========** KONFIG [set object's properties] **==========//
	public function konfig($konfig = 'oKONFIG')
	{

		// Determine configuration
		if (empty($konfig) || $konfig == 'oKONFIG') {
			global $oKonfig;
			if (!empty($oKonfig)) {
				$konfig = $oKonfig;
			}
		}

		// Peform configuration data check
		if (empty($konfig) || !is_array($konfig)) {
			exit('Configuration is required');
		}

		// Set timezone as property
		if (empty($konfig['zone']) && empty($this->zone)) {
			$this->zone();
		} elseif (!empty($konfig['zone'])) {
			if (empty($this->zone)) {
				$this->zone($konfig['zone']);
			}
			unset($konfig['zone']);
		}

		// Set properties using configuration's data
		foreach ($konfig as $label => $value) {
			if (is_array($value) && $label != 'link_allowed' && $label != 'noauths') {
				foreach ($value as $sub_label => $sub_value) {
					$subLabel = $label . '_' . $sub_label;
					if (empty($this->$subLabel)) {
						$this->$subLabel = $sub_value;
					}
				}
			} elseif (empty($this->$label)) {
				$this->$label = $value;
			}
		}
	}


	//==========** INITIALIZE **==========//
	public function init($zone = 'oZERN')
	{
		// Disable App when MODE is undefined or set to off
		if (!defined('oAPPMODE') || oAPPMODE == '' || oAPPMODE == 'OFF') {
			exit;
		}

		// Define Separators
		defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
		defined('PS') ? null : define('PS', '/');

		mb_internal_encoding("UTF-8");
		ini_set('session.cache_limiter', 'public');
		session_cache_limiter(false);
		return;
	}









	//========== IP VALIDATOR [returns true/false] ==========//
	public function isIP($host = '')
	{
		if (empty($host)) {
			return 'ZE428-IV1: [Argument Required]';
		} else {
			$parts = parse_url($host);
			if (!isset($parts['host'])) {
				$o = (bool) ip2long($host);
			} else {
				$o = (bool) ip2long($parts['host']);
			}
			return $o;
		}
		return false;
	}
	//==========** END **==========//


	//========== BASEPATH [root directory & url] ==========//
	public function BP($task = 'oDIR', $path = 'oPREP')
	{
		if (empty($task)) {
			exit('ZE428-BP1: [Argument Required]');
		} elseif (empty($path)) {
			exit('ZE428-BP2: [Argument Required]');
		} elseif ($task != 'oDIR' && $task != 'oHOST') {
			exit('ZE406-BP1: [Invalid Argument Input]');
		} else {
			$o = '';
			if ($path == 'oPREP') {
				if ($task == 'oHOST' && !empty($_SERVER["SERVER_NAME"])) {
					$o = $_SERVER["SERVER_NAME"];
					if (!empty($this->konfig)) {
						$konfig = $this->konfig;
						if (($this->isIP($o) || $o == 'localhost') && !empty($konfig['ifip'])) {
							$o = $o . PS . $konfig['ifip'];
						}
					}
				} elseif ($task == 'oDIR' && !empty($_SERVER["DOCUMENT_ROOT"])) {
					$o = $_SERVER["DOCUMENT_ROOT"];
				}
			} else {
				if ($task == 'oHOST') {
					#TODO ~ check that $path is valid host
					$o = $path;
				} elseif ($task == 'oDIR') {
					$pathinfo = pathinfo($path);
					if (!empty($pathinfo['dirname'])) {
						$o = $pathinfo['dirname'] . DS;
					}
				}
			}
			return $o;
		}
	}
	//==========** END **==========//


	//========== SET BASEPATH ==========//
	public function setBP($task = '', $path = '')
	{
		$o = $this->BP($task, $path);
		if (!empty($o['oERROR'])) {
			return $o;
		} elseif (!empty($o) && $o !== false) {
			if ($task == 'oHOST') {
				$this->oHost = $o;
			} elseif ($task == 'oDIR') {
				$this->oDir = $o;
			}
			return true;
		}
		return false;
	}
	//==========** END **==========//


	//==========** INITIALIZE APPLICATION [set properties] **==========//
	public function initApp($konfig = 'oKONFIG')
	{
		/*** Maintain PHP Session ***/
		if (class_exists('oSession')) {
			oSession::start();
		}
		$this->konfig($konfig);
		$this->setRoute();
		$this->setURL();
		if (isset($this->db_name)) {
			$this->setDB();
		}
	}



	//========== GET CONFIGURATION ==========//
	public function getKonfig($label = 'oKONFIG')
	{
		if (empty($label)) {
			return 'ZE428-GK1: [Argument Required]';
		} else {
			$o = $this->konfig;
			if (empty($o)) {
				return 'ZE404-GK1: [No Data]';
			} elseif (!is_array($o)) {
				return 'ZE406-GK1: [Invalid Data]';
			} else {
				if ($label == 'oKONFIG') {
					return $o;
				} elseif (in_array($label, $o)) {
					return $o[$label];
				}
			}
		}
		return false;
	}
	//==========** END **==========//


	//========== SET ROUTE ==========//
	public function setRoute($eval = '')
	{
		if (class_exists('oURL')) {
			if (empty($this->oRoute)) {
				$this->oRoute = oURL::route($eval);
			}
			$uriData = oURL::uriData();
			if (!empty($uriData)) {
				$this->oURI = $uriData['uri'];
				$this->oLink = $uriData['link'];
				$this->oAction = $uriData['action'];
				$this->oCase = $uriData['case'];
			}
		}
		return;
	}
	//==========** END **==========//


	//========== SET BASEURL ==========//
	public function setURL()
	{
		if (!empty($this->oHost)) {
			$o = $this->oHost;
		} elseif (defined('zernURL')) {
			$o = zernURL;
		} elseif (!empty($_SERVER["SERVER_NAME"])) {
			$o = $_SERVER["SERVER_NAME"];
		}

		if (!empty($o)) {
			if (oKit::hasSSL()) {
				$o = 'https://' . $o;
			} else {
				$o = 'http://' . $o;
			}
			$this->oURL = $o;
			return true;
		}
		return false;
	}
	//==========** END **==========//


	//========== CONFIGURE DATABASE & MAKE CONNCTION ==========//
	public function setDB()
	{
		$db = array();
		if (!empty($this->timezone)) {
			$db['timezone'] = $this->timezone;
		}
		if (!empty($this->db_name)) {
			$db['name'] = $this->db_name;
			unset($this->db_name);
		} else {
			$db['name'] = 'zenq';
		}
		if (!empty($this->db_user)) {
			$db['user'] = $this->db_user;
			unset($this->db_user);
		} else {
			$db['user'] = 'zenq';
		}
		if (!empty($this->db_pass)) {
			$db['pass'] = $this->db_pass;
			unset($this->db_pass);
		} else {
			$db['pass'] = 'ZenQ';
		}
		if (!empty($this->db_host)) {
			$db['host'] = $this->db_host;
			unset($this->db_host);
		} else {
			$db['host'] = 'localhost';
		}
		if (!empty($this->db_table)) {
			$db['table'] = $this->db_table;
			unset($this->db_table);
		} else {
			$db['table'] = 'userz';
		}
		if (!empty($this->db_driver)) {
			$db['driver'] = $this->db_driver;
			unset($this->db_driver);
		} else {
			$db['driver'] = 'PDO';
		}
		if (!empty($db)) {
			#TODO ~ determine driver from config
			if (class_exists('oPDO')) {
				$zernDB = new oPDO($db);
				if (is_object($zernDB)) {
					$this->DB = $zernDB;

					/*** Call Auth ***/
					if (class_exists('oAuth')) {
						if (!empty($this->oURL)) {
							$zernAuth = new oAuth($this->DB, $this->oURL, $this->oLink);
						} else {
							$zernAuth = new oAuth($this->DB, '', '');
						}
						if (is_object($zernAuth)) {
							$this->Auth = $zernAuth;
						}
					}
				}
			}
		}
		return;
	}
	//==========** END **==========//


	//========== ROUTER HANDLER ==========//
	public function router($link = 'oGET', $route = 'oGET')
	{
		if (empty($link) || $link == 'oGET') {
			$link = $this->oLink;
		}
		if (empty($route) || $route == 'oGET') {
			$route = $this->oRoute;
		}

		if (!empty($this->link_allowed) && array_key_exists($link, $this->link_allowed)) {
			if (!empty($this->link_allowed[$link])) {
				$organizer = oRGANIZ . strtolower($this->link_allowed[$link]) . '.php';
			} else {
				$organizer = oRGANIZ . $link . '.php';
				if (!file_exists($organizer)) {
					if (!empty($this->link_allowed['default'])) {
						$organizer = oRGANIZ . strtolower($this->link_allowed['default'] . '.php');
					} else {
						$organizer = oRGANIZ . 'index.php';
					}
				}
			}

			if (file_exists($organizer)) {
				$o = $organizer;
			} else {
				if (defined('oAPPMODE') && oAPPMODE == 'DEV') {
					exit("<p>Missing Organizers:<br> REQUESTED - <strong>[" . oRGANIZ . "{$link}.php]</strong><br> DEFAULT - [<strong>{$organizer}]</strong></p>");
				} elseif (defined('oAPPMODE') && oAPPMODE == 'BETA') {
					exit("The resource [<strong>{$link}]</strong> is unavailable");
				} else {
					oHTML::eHTTPView(404);
				}
			}
		} else {
			$http = oDESIGN . 'ehttp.php';
			if (file_exists($http)) {
				$o = $http;
			} else {
				oHTML::eHTTPView(400);
			}
		}

		return $o;
	}
	//==========** END **==========//


	//========== DOCUMENT TITLE ==========//
	public function title($return = 'oPAGE')
	{
		$title = '';
		if ($this->oLink != 'index') {
			#TODO ~ capitalize certain words
			$capWords = array('hmo');
			if (in_array($this->oLink, $capWords)) {
				$this->oLink = strtoupper($this->oLink);
			}
			$title = trim($this->oLink);
			$title = str_replace('-', ' ', $this->oLink);
			if (!empty($this->oAction) && $this->oAction != 'default') {
				$title = $this->oAction . ' ' . $title;
			}
		}

		#if return page title
		if ($return == 'oPAGE') {
			if (!empty($title)) {
				$title = $title . ' - ';
			}
			$title = $title . $this->project;
		}


		if (!empty($title)) {
			return $title = ucwords($title);
		}
		return false;
	}
	//==========** END **==========//



	//========== VIEW [get & set] ==========//
	public function view($data = '')
	{
		#TODO ~ set view
		if (empty($data)) {
			$link = $this->oLink;
			$action = $this->oAction;
		}
		$o = $link;
		if ($action != 'default') {
			$o .= '_' . $action;
		}
		return $o . '.php';
	}
	//==========** END **==========//



	//========== FILE LOADER [only add files] ==========//
	public static function inc($file = '', $eval = 'oREQUIRED')
	{
		if (!empty($file) && !is_file($file)) {
			$file = $file . '.php';
		}
		if (file_exists($file)) {
			require $file;
		} elseif ($eval == 'oREQUIRED') {
			if (!defined('oAPPMODE') || oAPPMODE != 'dev') {
				exit('ZE404-IF: ' . basename($file));
			} else {
				exit('Missing Library: ' . $file);
			}
		}
	}
	//==========** END **==========//



	//========== LINK FILES ==========//
	public function linkToFile($name = '', $as = 'oAUTO', $url = 'oAUTO')
	{
		$o = '';
		if (!empty($name)) {
			if ($as == 'oAUTO') {
				if (oText::in($name, '.css')) {
					$o = CSS . $name;
				} elseif (oText::in($name, '.js')) {
					$o = JS . $name;
				} elseif (oText::in($name, '.ico')) {
					$o = ICON . $name;
				} elseif (oText::in($name, '-icon')) {
					$o = ICON . $name;
				}
			}
		}

		if ($url == 'oAUTO') {
			if (!empty($this->oURL)) {
				$o = $this->oURL . PS . $o;
			}
		}

		if (!empty($o)) {
			return $o;
		}
	}
	//==========** END **==========//


	//========== LINK FILES ==========//
	public function linkSelf($url = 'oAUTO')
	{
		$o = '';
		if (!empty($this->oLink)) {
			$o = PS . $this->oLink;
		}
		if ($url == 'oAUTO') {
			if (!empty($this->oURL)) {
				$o = $this->oURL . $o;
			}
		}
		return $o;
	}
	//==========** END **==========//



	//========== DEBUG ==========//
	public static function dbug($data, $printAs = '', $continue = 'oYEAP')
	{
		if ($printAs == 'oJSON') {
			jsonResp($data);
		} else {
			echo '<p><em>Debugging</em></p><hr>';
			if ($printAs == 'oPRINT') {
				print_r($data);
			} elseif ($printAs == 'oDUMP') {
				var_dump($data);
			} elseif ($printAs == 'oEXPORT') {
				var_export($data);
			} elseif ($data === true) {
				echo "Bool: TRUE";
			} elseif ($data === false) {
				echo "Bool: FALSE";
			} elseif (is_int($data)) {
				echo $data;
			} elseif (is_string($data) && $printAs == 'string') {
				echo $data;
			} elseif (is_array($data)) {
				foreach ($data as $key => $value) {
					if (is_array($value)) {
						foreach ($value as $valueKey => $valueSub) {
							echo ' <strong>' . $key . "</strong>['" . $valueKey . "']" . ': ' . $valueSub . '<br>';
						}
					} else {
						echo '<strong>' . $key . ':</strong> ' . $value . '<br>';
					}
				}
			} else {
				var_dump($data);
			}
		}
		if ($continue == 'oNOPE') {
			exit;
		}
	}
	//==========** END **==========//
}
?>