<?php
class oPeriod {
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



	public static function isTimestamp($timestamp)
	{
		$check = (is_int($timestamp) OR is_float($timestamp)) ? $timestamp : (string) (int) $timestamp;
		return  ($check === $timestamp) AND ( (int) $timestamp <=  PHP_INT_MAX) AND ( (int) $timestamp >= ~PHP_INT_MAX);
	}

	//-------------- Return time in micro floats ---------------
	public static	function doMicro(){
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}


	//****** CREATE DATE & TIME, RETURN [formated] ******//
	public static	function create($period='oNOW', $type='oDATE'){
		if($period == 'oNOW' || $period == 'oTODAY'){$period = time();}
		if(!self::isTimestamp($period)){$period = strtotime($period);}

		#Format
		if($type == 'oDATE'){$format = 'd-M-Y';}
		elseif($type == 'oDATED1'){$format = 'd/m/Y';}
		elseif($type == 'oDATED2'){$format = 'd-m-Y';}
		elseif($type == 'oDATED3'){$format = 'F d, Y';}
		elseif($type == 'oDATED4'){$format = 'l, F d, Y';}

		elseif($type == 'oTIME'){$format = 'h:i:s A';}

		elseif($type == 'oDATETIME'){$format = 'l, F d, Y h:i:s A';}

		elseif($type == 'oMYSQLDATETIME'){$format = 'Y-m-d H:i:s';}
		elseif($type == 'oMYSQLDATE'){$format = 'Y-m-d';}
		elseif($type == 'oMYSQLTIME'){$format = 'H:i:s';}

		elseif($type == 'oREPORT'){$format = 'd/m/Y h:i:s A';}

		elseif($type == 'oLETTER1'){return date('j').'<sup>'.date('S').'</sup> '.date('F, Y');}
		elseif($type == 'oLETTER2'){return date('M j').'<sup>'.date('S').'</sup> '.date('Y');}
		elseif($type == 'oLETTER3'){return date('F j').'<sup>'.date('S').'</sup> '.date('Y');}
		elseif($type == 'oUNIX'){return $period;}
		else {$format = $type;}

		return date($format, $period);
	} //****** END ******//


	//****** COMPUTE TIME DIFFERENCE, RETURN SECONDS ******//
	public static function secondsApart($past, $future='oNOW')
	{
		if(!empty($past) && !empty($future)){
			if($future == 'oNOW' || $future == 'oTODAY'){$future = time();}
			$resolve = $future - $past;
			return $resolve;
		}
		return false;
	} //****** END ******//


	public static function secondsTo($seconds, $convert='oMINUTE')
	{
		if($convert == 'oMINUTE'){$resolve = ($seconds / 60);}
		if($convert == 'oHOUR'){$resolve = ($seconds / 60) / 60;}
		if($convert == 'oDAY'){$resolve = (($seconds / 60) / 60) / 24;}

		return $resolve;
	}



	//-------------- Calculates time spent {from the past - unixtime} untill now - Returns array ---------------
	public static function timeDiff($pastUnixTime='', $futureUnixTime='now'){
		if(isEmpty($pastUnixTime)){return false;} #TODO - make sure its valid unix timestamp

		if(isEmpty($futureUnixTime) || $futureUnixTime == 'now'){$now = time();} else {$now = $futureUnixTime;}
		$nowDate = date("j", $now); $nowMonth = date("n", $now); $nowyear = date("Y", $now);
		$timeDate = date("j", $pastUnixTime); $timeMonth = date("n", $pastUnixTime); $timeYear = date("Y", $pastUnixTime);
		$spent = "  => "; $numVar = 0; $unit ="  => ";
		if($now >= $pastUnixTime){
			switch(true){
				case($now-$pastUnixTime < 60):
					#RETURNS SECONDS
				$seconds = $now-$pastUnixTime; $spent = $seconds; $numVar = 773; $unit = 'second';
				break;

				case ($now-$pastUnixTime < 3600):
					#RETURNS MINUTES
				$minutes = round(($now-$pastUnixTime)/60); $spent = $minutes; $numVar = 774; $unit = 'minute';
				break;

				case ($now-$pastUnixTime < 86400):
					#RETURNS HOURS
				$hours = round(($now-$pastUnixTime)/3600); $spent = $hours; $numVar = 775; $unit = 'hour';
				break;

				case ($now-$pastUnixTime < 1209600):
					#RETURNS DAYS
				$days = round(($now-$pastUnixTime)/86400); $spent = $days; $numVar = 776; $unit = 'day';
				break;

				case (mktime(0, 0, 0, $nowMonth-1, $nowDate, $nowyear) < mktime(0, 0, 0, $timeMonth, $timeDate, $timeYear)):
					#RETURNS WEEKS
				$weeks = round(($now-$pastUnixTime)/604800); $spent = $weeks; $numVar = 777; $unit = 'week';
				break;

				case (mktime(0, 0, 0, $nowMonth, $nowDate, $nowyear-1) < mktime(0, 0, 0, $timeMonth, $timeDate, $timeYear)):
					#RETURNS MONTHS
				if($nowyear==$timeYear){$subtract = 0;} else {$subtract = 12;}
				$months = round($nowMonth-$timeMonth+$subtract); $spent = $months; $numVar = 778; $unit = 'month';
				break;

				default:
					#RETURNS YEARS
				if($nowMonth<$timeMonth){$subtract = 1;}
				elseif($nowMonth==$timeMonth){
					if($nowDate<$timeDate){$subtract = 1;}
					else {$subtract = 0;}
				}
				else {$subtract = 0;}
				$years = $nowyear-$timeYear-$subtract;
				$spent = $years;
				$numVar = 779;
				$unit = 'year';
				if($years == 0) {$spent = "  => "; $numVar = 0;}
				break;
			}

			return Array($numVar, $spent, $unit);
		}
		else {
			$msg = ' Please enter a past time';
			return printMsg($msg);
		}
	}

	//Return duration of time {from the past - unixtime} untill now
	function getTimeSpent($pastUnixTime='', $futureUnixTime='now'){
		if(!isEmpty($pastUnixTime)){
			$spent = self::timeDiff($pastUnixTime, $futureUnixTime);
			$count = $spent['1']; $unit = $spent['2'];
			if($count > 1){$unit = ($unit.'s');}
			return ($count.' '.$unit.' ago');
		}
		return FALSE;
	}


	//Returns age from date of birth {YYYY-MM-DD}
	function getAge($birthDate=''){
		if(isEmpty($birthDate)){return FALSE;}
		$time = time();
		$day = date("d", $time); $month = date("m", $time); $year = date("Y", $time);
		$birthDay = substr($birthDate, 8, 2); $birthMonth = substr($birthDate, 5, 2); $birthYear = substr($birthDate, 0, 4);
		if($month < $birthMonth){$subtract = 1;}
		elseif($month == $birthMonth){
			if($day < $birthDay){$subtract = 1;}
			else {$subtract = 0;}
		}
		else {$subtract = 0;}

		return $year-$birthYear-$subtract;
	}


//Calculate time diffrence - TODO - upgrade and add features
	function getTimeDifference($past='', $future=''){
		$past = new DateTime($past);
		$future = new DateTime($future);
		$interval = $past->diff($future);
		return $interval->format('%a total days');
	}
//Set default timezone
	function setTimezone($zone='domestic'){
		if(isEmpty($zone)){return FALSE;}

		if($zone == 'domestic'){$zone = date_default_timezone_set('Africa/Lagos');}
		else {
			$iszone = in_array($zone, timezone_identifiers_list());
			if(!$iszone){
				$msg = ' invalid timezone {'.$zone.'} ';
				return printMsg($msg);
			}
			else {$zone = date_default_timezone_set($zone);}
		}
		return $zone;
	}


	function isValidDateTimeString($str_dt, $str_dateformat, $str_timezone) {
  $date = DateTime::createFromFormat($str_dateformat, $str_dt, new DateTimeZone($str_timezone));
  return $date && DateTime::getLastErrors()["warning_count"] == 0 && DateTime::getLastErrors()["error_count"] == 0;
}



	/**
 * ===========================================================================
 *  Begin TIME & DATE functions, dependent and important to erko3 framework
 * ===========================================================================
 */
}
?>