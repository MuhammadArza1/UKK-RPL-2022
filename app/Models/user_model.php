<?php

namespace App\Models;

class User_model extends BaseModel  {

    public static function authenticate($nik, $pasword) {
        $data = BaseModel::csvFileToJson("users.csv");
        var_dump($data[0]);
        foreach ($data as $key => $value) {
            if ($value['nik'] == $nik && $value['password'] == $pasword) {
                return true;
            }
        }
        return false;
    }


    public static function create($nik, $pasword) {
        $data = BaseModel::csvFileToJson("users.csv");
        $exists = false;
        foreach ($data as $key => $value) {
            if ($value['nik'] == $nik) {
                $exists = true;
            }
        }
       
        if ($exists) {
            return -1;
        }

        file_put_contents("user.csv","\r\n".$nik.",".$pasword,FILE_APPEND);
        return 1;
    }

    public static function findByNIK($nik) {
        $data = BaseModel::csvFileToJson("users.csv");
        foreach ($data as $key => $value) {
            if ($value['nik'] == $nik) {
                return $value;
            }
        }
        return false;
    }


}