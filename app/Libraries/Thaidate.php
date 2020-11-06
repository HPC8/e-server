<?php

namespace App\Libraries;

class Thaidate
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    // return 31 ธันวาคม 2563
    public function dateFullmonth($date = '')
    {

        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            $strYear = date("Y", strtotime($date)) + 543;
            $strMonth = date("n", strtotime($date));
            $strDay = date("d", strtotime($date));
            $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

            switch ($strDay) {
                case "01":
                    $strDay = "1";
                    break;
                case "02":
                    $strDay = "2";
                    break;
                case "03":
                    $strDay = "3";
                    break;
                case "04":
                    $strDay = "4";
                    break;
                case "05":
                    $strDay = "5";
                    break;
                case "06":
                    $strDay = "6";
                    break;
                case "07":
                    $strDay = "7";
                    break;
                case "08":
                    $strDay = "8";
                    break;
                case "09":
                    $strDay = "9";
                    break;
            }

            $strMonthThai = $strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear";
        } else {
            return "ไม่ระบุ";
        }
    }

    // 31 ตุลาคม 2563 เวลา 10:10:10
    public function dateFulltime($date = '')
    {
        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            $strYear = date("Y", strtotime($date)) + 543;
            $strMonth = date("n", strtotime($date));
            $strDay = date("d", strtotime($date));
            $time = date("H:i", strtotime($date));
            $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

            switch ($strDay) {
                case "01":
                    $strDay = "1";
                    break;
                case "02":
                    $strDay = "2";
                    break;
                case "03":
                    $strDay = "3";
                    break;
                case "04":
                    $strDay = "4";
                    break;
                case "05":
                    $strDay = "5";
                    break;
                case "06":
                    $strDay = "6";
                    break;
                case "07":
                    $strDay = "7";
                    break;
                case "08":
                    $strDay = "8";
                    break;
                case "09":
                    $strDay = "9";
                    break;
            }

            $strMonthThai = $strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear เวลา $time น.";
        } else {
            return "ไม่ระบุ";
        }
    }

    // return 27 ปี 11 เดือน 8 วัน
    public function birthday($date = '')
    {
        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            $birthday = $date;
            $today = date("Y-m-d");
            list($byear, $bmonth, $bday) = explode("-", $birthday);
            list($tyear, $tmonth, $tday) = explode("-", $today);
            $mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear);
            $mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear);
            $mage = ($mnow - $mbirthday);
            $u_y = date("Y", $mage) - 1970;
            $u_m = date("m", $mage) - 1;
            $u_d = date("d", $mage) - 1;
            return "$u_y ปี $u_m เดือน $u_d วัน";
        } else {
            return "ไม่ระบุ";
        }
    }

    // 2563 ตามจริง
    public function yearth($date = '')
    {
        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            list($Y, $m) = explode('-', $date);
            switch ($m) {
                case "01":
                    $Y = $Y + 543;
                    break;
                case "02":
                    $Y = $Y + 543;
                    break;
                case "03":
                    $Y = $Y + 543;
                    break;
                case "04":
                    $Y = $Y + 543;
                    break;
                case "05":
                    $Y = $Y + 543;
                    break;
                case "06":
                    $Y = $Y + 543;
                    break;
                case "07":
                    $Y = $Y + 543;
                    break;
                case "08":
                    $Y = $Y + 543;
                    break;
                case "09":
                    $Y = $Y + 543;
                    break;
                case "10":
                    $Y = $Y + 543;
                    break;
                case "11":
                    $Y = $Y + 543;
                    break;
                case "12":
                    $Y = $Y + 543;
                    break;
            }

            return $Y;
        } else {
            return "ไม่ระบุ";
        }
    }

    // return 2563
    public function fiscalYear($date)
    {
        list($Y, $m) = explode('-', $date); // แยกวันเป็น ปี เดือน วัน
        switch ($m) {
            case "01":
                $Y = $Y + 543;
                break;
            case "02":
                $Y = $Y + 543;
                break;
            case "03":
                $Y = $Y + 543;
                break;
            case "04":
                $Y = $Y + 543;
                break;
            case "05":
                $Y = $Y + 543;
                break;
            case "06":
                $Y = $Y + 543;
                break;
            case "07":
                $Y = $Y + 543;
                break;
            case "08":
                $Y = $Y + 543;
                break;
            case "09":
                $Y = $Y + 543;
                break;
            case "10":
                $Y = $Y + 544;
                break;
            case "11":
                $Y = $Y + 544;
                break;
            case "12":
                $Y = $Y + 544;
                break;
        }
        return $Y;
    }
    // ธันวาคม
    public function fullmonth($date = '')
    {
        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            $strMonth = date("n", strtotime($date));
            $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

            $strMonthThai = $strMonthCut[$strMonth];

            return "$strMonthThai";
        } else {
            return "ไม่ระบุ";
        }
    }

    public function cutdate($date)
    {
        $strDay = date("d", strtotime($date));
        switch ($strDay) {
            case "01":
                $strDay = "1";
                break;
            case "02":
                $strDay = "2";
                break;
            case "03":
                $strDay = "3";
                break;
            case "04":
                $strDay = "4";
                break;
            case "05":
                $strDay = "5";
                break;
            case "06":
                $strDay = "6";
                break;
            case "07":
                $strDay = "7";
                break;
            case "08":
                $strDay = "8";
                break;
            case "09":
                $strDay = "9";
                break;
        }
        return "$strDay";
    }

    // 1 ต.ค. 2563
    public function shortdate($date = '')
    {

        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            $strYear = date("Y", strtotime($date)) + 543;
            $strMonth = date("n", strtotime($date));
            $strDay = date("d", strtotime($date));
            $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

            switch ($strDay) {
                case "01":
                    $strDay = "1";
                    break;
                case "02":
                    $strDay = "2";
                    break;
                case "03":
                    $strDay = "3";
                    break;
                case "04":
                    $strDay = "4";
                    break;
                case "05":
                    $strDay = "5";
                    break;
                case "06":
                    $strDay = "6";
                    break;
                case "07":
                    $strDay = "7";
                    break;
                case "08":
                    $strDay = "8";
                    break;
                case "09":
                    $strDay = "9";
                    break;
            }

            $strMonthThai = $strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear";
        } else {
            return "ไม่ระบุ";
        }
    }

    // ตุลาคม 2556
    public function fullMonthYear($date = '')
    {
        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            $strYear = date("Y", strtotime($date)) + 543;
            $strMonth = date("n", strtotime($date));
            $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

            $strMonthThai = $strMonthCut[$strMonth];
            return "$strMonthThai $strYear";
        } else {
            return "ไม่ระบุ";
        }
    }

    // ต.ค. 2556
    public function shortMonthYear($date = '')
    {
        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            $strYear = date("Y", strtotime($date)) + 543;
            $strMonth = date("n", strtotime($date));
            $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

            $strMonthThai = $strMonthCut[$strMonth];
            return "$strMonthThai $strYear";
        } else {
            return "ไม่ระบุ";
        }
    }

    // 1 ตุลาคม
    public function dateMonth($date = '')
    {

        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            $strMonth = date("n", strtotime($date));
            $strDay = date("d", strtotime($date));
            $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

            switch ($strDay) {
                case "01":
                    $strDay = "1";
                    break;
                case "02":
                    $strDay = "2";
                    break;
                case "03":
                    $strDay = "3";
                    break;
                case "04":
                    $strDay = "4";
                    break;
                case "05":
                    $strDay = "5";
                    break;
                case "06":
                    $strDay = "6";
                    break;
                case "07":
                    $strDay = "7";
                    break;
                case "08":
                    $strDay = "8";
                    break;
                case "09":
                    $strDay = "9";
                    break;
            }

            $strMonthThai = $strMonthCut[$strMonth];
            return "$strDay $strMonthThai";
        } else {
            return "ไม่ระบุ";
        }
    }

    // 1 ต.ค.
    public function dateShortMonth($date = '')
    {
        if ($date) {
            if ($date == '0000-00-00') {
                return "ไม่ระบุ";
            }
            $strMonth = date("n", strtotime($date));
            $strDay = date("d", strtotime($date));
            $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

            switch ($strDay) {
                case "01":
                    $strDay = "1";
                    break;
                case "02":
                    $strDay = "2";
                    break;
                case "03":
                    $strDay = "3";
                    break;
                case "04":
                    $strDay = "4";
                    break;
                case "05":
                    $strDay = "5";
                    break;
                case "06":
                    $strDay = "6";
                    break;
                case "07":
                    $strDay = "7";
                    break;
                case "08":
                    $strDay = "8";
                    break;
                case "09":
                    $strDay = "9";
                    break;
            }

            $strMonthThai = $strMonthCut[$strMonth];
            return "$strDay $strMonthThai";
        } else {
            return "ไม่ระบุ";
        }
    }

    public function rangeDate($start, $end)
    {
        if ($this->fullmonth($start) == $this->fullmonth($end)) {
            if ($this->cutdate($start) == $this->cutdate($end)) {
                return $this->shortdate($start);
            } else {
                return $this->cutdate($start) . '-' . $this->cutdate($end) . ' ' . $this->shortMonthYear($start);
            }
        } elseif ($this->yearth($start) == $this->yearth($end)) {
            return $this->dateShortMonth($start) . ' - ' . $this->shortdate($end);
        } else {
            return $this->shortdate($start) . ' - ' . $this->shortdate($end);
        }
    }

    public function rangeDateFull($start, $end)
    {
        if ($this->fullmonth($start) == $this->fullmonth($end)) {
            if ($this->cutdate($start) == $this->cutdate($end)) {
                return $this->dateFullmonth($start);
            } else {
                return $this->cutdate($start) . '-' . $this->cutdate($end) . ' ' . $this->fullMonthYear($start);
            }
        } elseif ($this->yearth($start) == $this->yearth($end)) {
            return $this->dateMonth($start) . ' - ' . $this->dateFullmonth($end);
        } else {
            return $this->dateFullmonth($start) . ' - ' . $this->dateFullmonth($end);
        }
    }
}
