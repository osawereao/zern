<?php
class oSession
{
	private static $instance;
	private static $session;

	//****** @Prevent MULTIPLE INSTANCE  ******//
	private function __construct()
	{
		return;
	}

	//****** @Prevent DUPLICATION [of class] INSTANCE  ******//
	private function __clone()
	{
		return;
	}

	//****** @Return SINGLE INSTANCE  ******//
	public static function instantiate()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	} //****** END ******//



	//-------------- Start session ---------------
	public static function start()
	{
		if (!isset($_SESSION)) {
			session_start();
			self::$session = 'active';
		}
	}


	//-------------- Return status (protected) ---------------
	protected static function check()
	{
		return self::$session;
	}


	//-------------- Return status ---------------
	public static function status()
	{
		if (!empty(self::$session)) {
			return self::$session;
		}
		return 'offline';
	}


	//-------------- Return 'TRUE' if session is active ---------------
	public static function active()
	{
		if (self::check() == 'active') {
			return true;
		}
		return false;
	}


	//-------------- Stop session ---------------
	public static function stop()
	{
		if (self::active()) {
			self::$session = 'inactive';
			session_destroy();
		}
	}


	//-------------- Unset session or session's variable ---------------
	public static function delete($process = 'o_all')
	{
		if (isset($_SESSION)) {
			if ($process == 'o_all') {
				session_unset();
			} elseif (isset($_SESSION[$process])) {
				unset($_SESSION[$process]);
			}
		}
		return;
	}


	//-------------- Terminate session ---------------
	public static function kill()
	{
		if (self::active()) {
			$_SESSION = array();
			if (ini_get("session.use_cookies")) {
				$params = session_get_cookie_params();
				setcookie(
					session_name(),
					'',
					time() - 42000,
					$params["path"],
					$params["domain"],
					$params["secure"],
					$params["httponly"]
				);
			}
			self::$session = 'inactive';
			session_unset();
			session_destroy();
		}
	}


	//-------------- Kill, the start session ---------------
	public static function restart()
	{
		self::start();
		self::kill();
		self::start();
	}
} // END SESSION CLASS
?>