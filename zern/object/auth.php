<?php

/**ZERN™ Framework ~ an evolving, robust platform for rapid & efficient development of modem responsive applications and APIs;
 * Built by ODAO™ [www.osawere.com] using PHP, SQL, HTML, CSS, JS & derived technology.
 * © July 2019 | beta 1.0 | Apache License, Version 2.0
 * ===================================================================================================================
 * Dependency » obj:DB, class:period
 * PHP | auth::zern ~ authentication class
 **/

class oAuth
{
	private $db;
	private $url;


	//========== CONSTRUCT ==========//
	public function __construct($connection, $url = '', $link = '')
	{
		if (is_object($connection)) {
			if (isset($connection->table)) {
				unset($connection->table);
			}
			$this->db = $connection;
			$this->url = $url;
			$this->link = $link;
		} else {
			die('Auth:: requires connection - #ZE001-DB');
		}
	}
	//==========** END **==========//



	//========== INSTANTIATE ==========//
	public static function instantiate($connection, $url = '')
	{
		if (is_null(self::$instance)) {
			self::$instance = new self($connection, $url);
		}
		return self::$instance;
	}
	//==========** END **==========//


	//****** @Return HUMAN READABLE INFORMATION  ******//
	public static function humanize($user)
	{
		if (!empty($user) && is_array($user)) {
			if (isset($user['password'])) {
				unset($user['password']);
			}
			if (!empty($user['username'])) {
				$user['username'] = self::ocrypt($user['username'], 'oDE64');
			}
			if (!empty($user['email'])) {
				$user['email'] = self::ocrypt($user['email'], 'oDE64');
			}
			if (!empty($user['type'])) {
				$user['type'] = self::ocrypt($user['type'], 'oDECODE');
			}
			if (!empty($user['surname'])) {
				$user['surname'] = self::ocrypt($user['surname'], 'oDECODE');
			}
			if (!empty($user['firstname'])) {
				$user['firstname'] = self::ocrypt($user['firstname'], 'oDECODE');
			}
			if (!empty($user['othername'])) {
				$user['othername'] = self::ocrypt($user['othername'], 'oDECODE');
			}
			if (!empty($user['sex'])) {
				$sex = strtolower($user['sex']);
				if ($sex == 'f') {
					$user['sex'] = 'Female';
				} elseif ($sex == 'm') {
					$user['sex'] = 'Male';
				}
			}
			return $user;
		}
	}

	//****** PASSWORD HASHING  ******//
	public static function password($password)
	{
		if (!empty($password)) {
			return password_hash($password, PASSWORD_BCRYPT);
		}
		return false;
	}

	//****** VERIFIY PASSWORD [HASHED]  ******//
	public static function isPassword($password, $hashed)
	{
		if (!empty($password) && !empty($hashed)) {
			if (password_verify($password, $hashed)) {
				return true;
			}
		}
		return false;
	} //****** END ******//


	//****** ENCRYPTION & DECRYPTION ******//
	public static function ocrypt(string $string, $action = 'oENCODE', $key = 'oZERN')
	{
		if ($action == 'oEN64') {
			return base64_encode($string);
		} elseif ($action == 'oDE64') {
			return base64_decode($string);
		} elseif ($action == 'oENCODE') {
			$pre = randomiz('oCRYPT3');
			$post = randomiz('oCRYPT5');
			return $pre . base64_encode($string) . $post;
		} elseif ($action == 'oDECODE') {
			$string = oText::trimNum($string, 5, 'oEND');
			$string = oText::trimNum($string, 3);
			return base64_decode($string);
		} elseif ($action == 'oENCRYPT' || $action == 'oDECRYPT') {
			$crypto = new oCrypt($key);
			if ($action == 'oENCRYPT') {
				return $crypto->encrypt($string);
			} elseif ($action == 'oDECRYPT') {
				return $crypto->decrypt($string);
			}
		} elseif ($action == 'oCRYPT') {
			return self::password($string);
		} elseif ($action == 'oVERIFY' && is_array($string)) {
			if (isset($string['string'])) {
				$input = $string['string'];
			}
			if (isset($string['hash'])) {
				$hash = $string['hash'];
			}

			if (!empty($input) && !empty($hash)) {
				return self::isPassword($input, $hash);
			}
		}
	} //****** END ******//


	//****** TIMEOUT USER SESSION ******//
	public static function timeIn()
	{
		$_SESSION['oLASTACTIME'] = time();
	} //****** END ******//


	//****** TIMEOUT USER SESSION ******//
	public function timeOut($location = 'locked', $duration = '1800', $auto = 'oYEAP')
	{
		if (isset($_SESSION['oLASTACTIME'])) {
			$timeIn = $_SESSION['oLASTACTIME'];
			$timeNow = time();
			if ($timeNow != $timeIn) {
				$timeDiff = oPeriod::secondsApart($timeIn, $timeNow);
				if ($timeDiff > 1) {
					$timeDiff = $timeDiff - 1;
				}
				if ($timeDiff >= $duration) {
					$_SESSION['oLOCKED'] = 'oYEAP';
				}
			}
		}

		if ($auto == 'oYEAP') {
			if (!empty($this->url)) {
				$location = $this->url . PS . $location;
			}
			oURL::redirect($location, ($duration));
		}
	} //****** END ******//


	//==========** ACTIVE USER [information] **==========//
	public function user($column = '*', $table = 'oUSER_TABLE', $return = 'oRECORD')
	{
		if (!empty($_SESSION['oUSER'])) {
			$cond['PUID'] = $_SESSION['oUSER'];
		}
		$o = $this->db->select($column, $table, $cond, 1, $return);
		if (!isset($o['oERROR'])) {
			return $o;
		}
		#TODO ~ log error resulting from QUERY [on production, die on development]
		return false;
	}


	//==========** AUTHENTICATE [user session] **==========//
	public function is()
	{
		$location = '';
		if (!empty($this->url)) {
			$location = $this->url;
		}
		if (empty($_SESSION['oUSER'])) {
			oURL::redirect($location . PS . 'login');
		} elseif (empty($_SESSION['oLOCKED'])) {
			oURL::redirect($location . PS . 'login');
		} elseif (!empty($_SESSION['oLOCKED']) && $_SESSION['oLOCKED'] == 'oYEAP') {
			oURL::redirect($location . PS . 'locked');
		} else {
			$user = $this->user('PUID');
			if ($user === false) {
				#TODO ~ log this improbable occurrence
				if (!empty($this->link) && $this->link != 'login') {
					oURL::redirect($location . PS . 'login');
				}
			} elseif (($user == 'oNORECORD') && (!empty($this->link) && $this->link != 'login')) {
				oURL::redirect($location . PS . 'login');
			}
			// 	} elseif(!empty($user['PUID'])){
			// 		#TODO
			// 	}
		}
	} //****** END ******//


	//****** LOGIN USER ******//
	public function login($userid, $password, $table = 'oUSER_TABLE')
	{
		if (!empty($userid) && !empty($password)) {
			$userid = oInput::clean($userid);
			$password = oInput::clean($password);
			$query = "SELECT `PUID`, `RUID`, `Type`, `Password` AS `password` FROM `{$table}`";
			$query .= " WHERE '" . self::ocrypt($userid, 'oEN64') . "' IN (`Email`, `Username`)";
			$query .= " OR `Phone` = '" . $userid . "'";
			$query .= ' LIMIT 1';

			$result = $this->db->runSQL($query, 'oRECORD');
			if ($result === false) {
				$resp['oSTATUS'] = 'oNOPE';
				$resp['oCODE'] = 'E600B3';
				return $resp;
			} elseif (isset($result['oERROR'])) {
				#TODO ~ Log Query Error
				$resp['oSTATUS'] = 'oNOPE';
				$resp['oCODE'] = 'E600B2';
				return $resp;
			} elseif ($result == 'oNORECORD') {
				$resp['oSTATUS'] = 'oNOPE';
				$resp['oCODE'] = 'E404A1';
				return $resp;
			} elseif (empty($result['password'])) {
				$resp['oCODE'] = 'E501A1'; #developer error (no implemented correctly)
				return $resp;
			} else {
				$passwordCheck = self::isPassword($password, $result['password']);
				unset($result['password']); #unset password as it has already been used

				if ($passwordCheck === false) {
					$resp['oSTATUS'] = 'oNOPE';
					$resp['oCODE'] = 'E401A1';
					return $resp;
				} else { #When password is valid
					oSession::start();
					if (!empty($result['PUID'])) {
						$_SESSION['oUSER'] = $result['PUID'];
						$_SESSION['oUSERID'] = $userid;
						$_SESSION['oLOCKED'] = 'oNOPE';
						$_SESSION['oLASTACTIME'] = time();
						$data['oUSER'] = $_SESSION['oUSER'];
						$resp['oDATA'] = $data;
					}
					$resp['oSTATUS'] = 'oYEAP';
					$resp['oCODE'] = 'E200A1';
					return $resp;
				}
			}
		}
	} //****** END ******//


	//****** LOGOUT USER ******//
	public function logout($linkNext = 'login?zern=logout')
	{
		#TODO ~ collect user and record logout information
		oSession::start();
		if (isset($_SESSION['oUSER'])) {
			oSession::delete('oUSER');
		}
		if (isset($_SESSION['oUSERID'])) {
			oSession::delete('oUSERID');
		}
		if (isset($_SESSION['oLOCKED'])) {
			oSession::delete('oLOCKED');
		}
		if (isset($_SESSION['oLASTACTIME'])) {
			oSession::delete('oLASTACTIME');
		}
		oSession::restart();
		if (!empty($linkNext)) {
			if (!empty($this->url)) {
				$linkNext = $this->url . PS . $linkNext;
			}
			oURL::redirect($linkNext);
		}
	} //****** END ******//


	//****** SESSION USER ******//
	public function userActive($column = '*')
	{
		if (!empty($_SESSION['oUSER'])) {
			$condition['PUID'] = $_SESSION['oUSER'];
			$user = $this->db->select($column, 'oUSER_TABLE', $condition, 1, 'oRECORD');
			if (!isset($user['oERROR'])) {
				if ($user == 'oNORECORD') {
					$this->app->redirect('login');
				} else {
					return self::humanize($user);
				}
			}
			#TODO ~ log error resulting from QUERY [on production, die on development]
			return false;
		}
	} //****** END ******//


	//****** MODIFY USER PASSWORD ******//
	public function updatePassword($puid, $password, $newpassword)
	{
		if (!empty($puid) && !empty($password) && !empty($newpassword)) {
			$resp = array();

			#Find user
			$column = array('PUID', 'password');
			$condition['PUID'] = $puid;
			$user = $this->db->select($column, 'oUSER_TABLE', $condition, 1, 'oRECORD');
			if (isset($user['oERROR'])) {
				$resp['oCODE'] = 'E600B2';
			} else {
				if ($user === false) {
					$resp['oCODE'] = 'E600B3';
				} elseif ($user == 'oNORECORD') {
					$resp['oCODE'] = 'E404A1';
				} else {
					if (!self::isPassword($password, $user['password'])) {
						$resp['oCODE'] = 'E401A1';
					} else {
						#Modify password with new password
						$udata = array();
						$cond = array();
						$udata['password'] = self::password($newpassword);
						$ucondition['PUID'] = $puid;

						$updatePW = $this->db->updateSQL('oUSER_TABLE', $udata, $ucondition, 1, 'oNUMROW');
						if ($updatePW === 1) {
							$this->app->redirect('locked?zern=password-changed');
						} else {
							#TODO ~
							$resp['oCODE'] = 'E304A1';
						}
					}
				}
			}
			return $resp;
		}
		return false;
	} //****** END ******//


	public static function isCrypt($crypted, $verify)
	{
		$string = self::crypt($crypted, 'decrypt');
		if ($string == $verify) {
			return true;
		}
		return false;
	}

	public static function restrict($input, $verify, $isCrypt = 'yeap', $redirect = '')
	{
		if ($isCrypt == 'yeap') {
			$valid = self::isCrypt($input, $verify);
			if (!$valid && !empty($redirect)) {
				URL::redirect($redirect);
			} elseif (!$valid) {
				return true;
			}
		} elseif ($input != $verify) {
			if (!empty($redirect)) {
				URL::redirect($redirect);
			}
			return true;
		}

		#false indicates that access should not be restricted
		return false;
	}
}
?>