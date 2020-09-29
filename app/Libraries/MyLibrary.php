<?php

namespace App\Libraries;

class MyLibrary
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    // cid validation
    public function validateCID($cid)
    {
        $arr_ph = explode("-", $cid);
        $nationalId = "";

        foreach ($arr_ph as $i) {
            $nationalId = $nationalId . $i;
        }

        if (strlen($nationalId) === 13) {
            $digits = str_split($nationalId);
            $lastDigit = array_pop($digits);

            $sum = array_sum(array_map(
                function ($d, $k) {
                    return ($k + 2) * $d;
                },
                array_reverse($digits),
                array_keys($digits)
            ));
            return $lastDigit === strval((11 - $sum % 11) % 10);
        }

        return FALSE;
    }

    // email validation
    public function validateEmail($email)
    {
        return preg_match('/^[^\@]+@.*.[a-z]{2,15}+.*.[a-z]$/i', $email) ? TRUE : FALSE;
    }

    public function getGen($data)
    {
        $today = date("Y-m-d");
		$GenZ = 0;
		$GenY = 0;
		$GenX = 0;
        $Baby = 0;
		foreach ($data as $row) {
			list($byear, $bmonth, $bday) = explode("-", $row->birthday);
			list($tyear, $tmonth, $tday) = explode("-", $today);
			$mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear);
			$mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear);
			$mage = ($mnow - $mbirthday);
			$age = date("Y", $mage) - 1970;

			if ($age <= 21) {
                $GenZ = $GenZ + 1;
			} elseif ($age >= 22 and $age <= 38) {
				$GenY = $GenY + 1;
			} elseif ($age >= 39 and $age <= 53) {
				$GenX = $GenX + 1;
			} else {
				$Baby = $Baby + 1;
			}
        }
        
		$Gen = array(
			'0' => array(
				'name' => 'GenZ',
				'count'  => $GenZ
			),
			'1' => array(
				'name' => 'GenY',
				'count'  => $GenY
			),
			'2' => array(
				'name' => 'GenX',
				'count'  => $GenX
			),
			'3' => array(
				'name' => 'Baby',
				'count'  => $Baby
			)

        );
        return $Gen;
    }

    
}
