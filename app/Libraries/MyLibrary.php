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

    public function bahtText($data)
    {
        if (!preg_match('/^([0-9]+)(\.[0-9]{0,4}){0,1}$/', $data = str_replace(',', '', $data), $m))
            return 'This is not currency format';
        $m[2] = count($m) == 3 ? intval(('0' . $m[2]) * 100 + 0.5) : 0;
        $st = $this->cv($m[2]);
        return $this->cv($m[1]) . 'บาท' . $st . ($st > '' ? 'สตางค์' : 'ถ้วน');
    }
    private function cv($num)
    {
        $th_num = array('', array('หนึ่ง', 'เอ็ด'), array('สอง', 'ยี่'), 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
        $th_digit = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
        $ln = strlen($num);
        $t = '';
        for ($i = $ln; $i > 0; $i--) {
            $x = $i - 1;
            $n = substr($num, $ln - $i, 1);
            $digit = $x % 6;
            if ($n != 0) {
                if ($n == 1) {
                    $t .= $digit == 1 ? '' : $th_num[1][$digit == 0 ? ($t ? 1 : 0) : 0];
                } elseif ($n == 2) {
                    $t .= $th_num[2][$digit == 1 ? 1 : 0];
                } else {
                    $t .= $th_num[$n];
                }
                $t .= $th_digit[($digit == 0 && $x > 0 ? 6 : $digit)];
            } else {
                $t .= $th_digit[$digit == 0 && $x > 0 ? 6 : 0];
            }
        }
        return $t;
    }
}
