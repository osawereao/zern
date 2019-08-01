<?php
//-------------- Random Generator ---------------
function randomiz($return = 'oCRYPT5')
{
	if ($return == 'oCHAR2') {
		$char = '=@#$%&*?';
		$chars = str_split($char);
		shuffle($chars);
		$randomiz = $chars[1] . $chars[3];
	}

	if ($return == 'oBIND') {
		$randomiz = mt_rand() . time();
	}

	if ($return == 'oCRYPT3' || $return == 'oCRYPT5' || $return == 'oUSERNAME' || $return == 'oPUID' || $return == 'oRUID' || $return == 'oSWIFT' || $return == 'oIMG') {
		$alpha = array_merge(range('A', 'Z'), range(0, 9), range('a', 'z'));
		shuffle($alpha);
		if ($return == 'oCRYPT3') {
			$randomiz = $alpha[7] . $alpha[33] . $alpha[51];
		}
		if ($return == 'oCRYPT5') {
			$randomiz = $alpha[5] . $alpha[18] . $alpha[32] . $alpha[25] . $alpha[44];
		}
		if ($return == 'oUSERNAME') {
			$randomiz = $alpha[3] . $alpha[38] . $alpha[15] . $alpha[45] . $alpha[53] . time() . $alpha[1] . $alpha[18] . $alpha[39] . $alpha[7] . $alpha[61];
		}
		if ($return == 'oPUID') {
			$randomiz = str_shuffle($alpha[17] . $alpha[32] . mt_rand() . $alpha[13] . $alpha[42] . randomiz('oBIND'));
		}
		if ($return == 'oRUID') {
			$randomiz = mt_rand() . $alpha[2] . $alpha[30] . $alpha[14] . $alpha[45] . $alpha[50] . mt_rand() . str_shuffle($alpha[10] . $alpha[19] . $alpha[49] . $alpha[8] . $alpha[61] . time() . $alpha[29] . $alpha[17] . $alpha[31]);
		}
	}

	if ($return == 'oLUID') {
		$randomiz = str_shuffle(randomiz('oPUID') . randomiz('oRUID'));
	}

	if ($return == 'accountno') {
		$randomiz = mt_rand(1000000000, 9999999999);
	}

	if ($return == 'oSWIFT') {
		$randomiz = $alpha[0] . $alpha[1] . $alpha[2] . $alpha[3] . $alpha[4];
	}

	if ($return == 'oIMG') {
		$randomiz = $alpha[0] . $alpha[1] . $alpha[2];
		$randomiz .= mt_rand(1000, 9999) . $alpha[3] . $alpha[4] . $alpha[5];
		$randomiz .= $alpha[9] . mt_rand(1, 999) . $alpha[6] . $alpha[7] . $alpha[8];
	}

	if(!empty($randomiz)){return $randomiz;}
	return mt_rand();
}
?>