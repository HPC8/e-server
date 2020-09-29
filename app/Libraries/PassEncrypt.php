<?php

namespace App\Libraries;

class PassEncrypt
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }
    public function utf8_strrev($str)
    {
        preg_match_all('/./us', $str, $ar);
        return join('', array_reverse($ar[0]));
    }
    public function passwordEncrypt($cid)
    {
        //remove - icd
        $nationalId = "";
        $arr_ph = explode("-", $cid);
        foreach ($arr_ph as $i) {
            $nationalId = $nationalId . $i;
        }

        //you secret word
        $key1    = 'suthat';
        $key2    = 'hpc8';
        $loop    = 1;
        $reverse = $this->utf8_strrev($nationalId);  //กลับตัวอักษร 

        // ทำการเข้ารหัส 1 ครั้ง 
        for ($i = 0; $i < $loop; $i++) {
            $md5 = md5($reverse); // เข้ารหัสเป็น 32 หลัก
            $reverse_md5 = $this->utf8_strrev($md5);  //กลับตัวอักษร md5
            $salt = substr($reverse_md5, -13) . md5($key1) . substr($reverse_md5, 0, 19) . md5($key2);  //สร้างข้อความใหม่ secret
            $new_md5 = md5($salt);  //เข้ารหัสเป็น 32 หลัก
            $reverse = $this->utf8_strrev($new_md5); //กลับตัวอักษรอีกครั้ง
        }
        return md5($reverse);
    }

    public function passwordHash($pass)
    {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        return $pass;
    }

    public function passwordVerify($pass, $pass_db)
    {
        if (password_verify($this->passwordEncrypt($pass), $pass_db)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function passwdPattern($passwd)
    {
        //return preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%_])[0-9A-Za-z!@#$%_]{6,32}$/', $passwd)?TRUE: FALSE;
        return preg_match('/^(?=.*\d)[0-9A-Za-z!@#$%_]{6,32}$/', $passwd) ? TRUE : FALSE;
    }
}
