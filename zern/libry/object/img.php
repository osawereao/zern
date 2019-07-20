<?php
class oIMG {
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



	//-------------- Display Photo ---------------
	public static function DP($file='', $sex='', $path='icon')
	{
		if(empty($file)){
			if(!empty($sex)){
				$sex = strtolower($sex);
				if($sex == 'female'){$sex = 'f';}
				elseif($sex == 'male'){$sex = 'm';}
				$image = $sex.'-user.png';
			} else {
				$image = 'user.png';
			}
		}
		else {
			$image = $file;
		}
		if(!empty($path)){$image = $path.'/'.$image;}
		if(!file_exists($image)){return $image;}
		return 'none.png';
	}


	function fileUploadErrorMsg($code)
	{
		//errors
		$errors = array(
			// 0 => 'There is no error, the file uploaded with success',
			1 => 'The selected file size is too large',
			2 => 'The selected file exceeds the maximum allowed size',
			3 => 'The file was only partially uploaded',
			4 => 'No file was uploaded',
			6 => 'Missing a temporary folder',
			7 => 'Failed to write file to disk.',
			8 => 'A PHP extension stopped the file upload.'
		);

		if ($code == 1 || $code == 2) {
			return 'The selected file for upload is too large';
		}
		return $errors[$code];
	}
}
?>