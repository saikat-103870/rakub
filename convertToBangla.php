<?php

		function e2b($englishNumber)
		{
			/*
			$englishNumber = (string) $englishNumber;
			$banglaNumber = '';
			$indexLimit = strlen($englishNumber);
			for($i=0; $i<$indexLimit; $i++)
			{
				switch($englishNumber[$i])
				{
					case "0":
						$banglaNumber .= '&#2534;';
						break;
					case "1":
						$banglaNumber .= '&#2535;';
						break;
					case "2":
						$banglaNumber .= '&#2536;';
						break;
					case "3":
						$banglaNumber .= '&#2537;';
						break;
					case "4":
						$banglaNumber .= '&#2538;';
						break;
					case "5":
						$banglaNumber .= '&#2539;';
						break;
					case "6":
						$banglaNumber .= '&#2540;';
						break;
					case "7":
						$banglaNumber .= '&#2541;';
						break;
					case "8":
						$banglaNumber .= '&#2542;';
						break;
					case "9":
						$banglaNumber .= '&#2543;';
						break;
					default:
						$banglaNumber .= $englishNumber[$i];
						break;
				}
			}
			*/

		$bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
		$banglaNumber = str_replace(range(0, 9),$bn_digits, $englishNumber);
		return $banglaNumber;
		}
		
		function b2e($bnNo)
		{
		//$bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
		//$bn_digits=array('0','1','2','3','4','5','6','7','8','9');
		//$enNumber = str_replace($bn_digits,range(0, 9),$bnNo);
		$search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
		$replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
		$en_number = str_replace($search_array, $replace_array, $bnNo);
			
		return $en_number;
		}
		
		function BloodGroup($grp)
		{
		$search_array= array("বি পজিটিভ", "ও পজিটিভ", "এ পজিটিভ", "এবি পজিটিভ", "বি নেগেটিভ", "এ নেগেটিভ", "বি মাইনাস", "ও নেগেটিভ", "এবি নেগেটিভ");
		$replace_array= array("B+", "O+", "A+","AB+", "B-", "A-", "B-", "O-", "AB-");
		$optGrp = str_replace($search_array, $replace_array, $grp);
	
		return $optGrp;
		}

?>

