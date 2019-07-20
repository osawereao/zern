<?php
class oText {
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


	//-------------- Find needle in string and return boolean ---------------
	public static function in($string, $needle){
		$string = (string) $string;
		$needle = (string) $needle;
		if(strpos($string, $needle) !== false){return true;}
		return false;
	}

	public static function same($string, $compare){
		if($string === $compare){ return true;}
		return false;
	}

	//-------------- Replace [SPACE] with [CHAR/STRING] & reverse ---------------
	public static function spaceTo($string, $character, $inverse='nope'){
		if($inverse!='nope'){return str_replace($character, ' ', $string);}
		return preg_replace('/\s+/', $character, $string);
	}


	//-------------- String Replacement ---------------
	public static function swap($subject='', $search='', $replace='', $occurence='oALL'){
		$occurences = array('oALL', 'oFIRST', 'oLAST');
		if(isEmpty($subject) || is_null($search) || is_null($replace) || isEmpty($occurence) || !in_array($occurence, $occurences)){
			$msg = 'One or more errors occurred with the argument on '.__FUNCTION__.'()';
			return printMsg($msg);
		}

		#Cast to String
		$subject = (string) $subject;
		$search = (string) $search;
		$replace = (string) $replace;

		$isfound = strstr($subject, $search); //check if $search is found, else return full string
		if(!$isfound){$chore = $subject;}
		else {
			if($occurence=='oALL'){$chore = str_replace($search, $replace, $subject);}
			else {
				if($occurence=='oFIRST'){$pos = strpos($subject, $search);}
				if($occurence=='oLAST'){$pos = strrpos($subject, $search);}
				if($pos !== false){$chore = substr_replace($subject, $replace, $pos, strlen($search));}
				else {$chore = $subject;}
			}
		}
		return $chore;
	}


	//-------------- Remove [CHAR/STRING] from edges ---------------
	public static function trimEdge($string, $character){
		$chore = trim($string);
		$chore = preg_replace('/\s+/', '', $chore);
		if(!isEmpty($character)){$chore = trim($chore, $character);}
		return $chore;
	}


	//-------------- Remove [No of Characters] from string edge ---------------
	public static function trimNum(string $string, int $num, $from='oSTART', $length='oALL')
	{
		if(!empty($string) && !empty($num) && !empty($from)){
			$strlength = strlen($string);
			if($num < $strlength){
				if($length == 'oALL'){
					if($from == 'oSTART'){
						return substr($string, $num);
					}
					else {
						return substr($string, 0, -$num);
					}
				}
				elseif(is_int($length)){
					#TODO
				}
			}
		}
		return false;
	}


	public static function nthChar($string, $nth){ #nth is position ie value has to be numberic
		$length = strlen($string);
		if($nth<=$length){
			$nth = (int)$nth -1;
			return $string[$nth];
		}
		return false;
	}




	public static function before($subject, $needle, $strip='oYEAP'){
		$pos = strpos($subject, $needle);
		$chore = '';
		if($pos && $pos!=0){$chore = substr($subject, 0, $pos);}
		if($strip !='oYEAP'){$chore = $chore.$needle;}
		return $chore;
	}

	public static function after($subject, $needle, $strip='oYEAP'){
		$chore = strstr($subject, $needle);
		if($chore){
			if($strip =='oYEAP'){
				$chore = str_replace($needle, '', $chore);
			}
		}
		return $chore;
	}

	public static function partOf($input, $length, $ellipses = true, $strip_html = true) {
		//strip tags, if desired
		if ($strip_html) {$input = strip_tags($input);}

		//no need to trim, already shorter than trim length
		if (strlen($input) <= $length) {return $input;}

		//find last space within length
		$last_space = strrpos(substr($input, 0, $length), ' ');
		$trimmed_text = substr($input, 0, $last_space);

		//add ellipses (...)
		if ($ellipses) {$trimmed_text .= '...';}

		return $trimmed_text;
	}
}
?>