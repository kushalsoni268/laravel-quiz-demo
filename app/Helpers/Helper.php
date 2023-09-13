<?php

namespace App\Helpers;

use Request;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;
use App\Models\User;
use URL;

class Helper
{
    public static function res($data, $msg, $code)
    {
        $response = [
            'status' => $code == 200 ? true : false,
            'code' => $code,
            'msg' => $msg,
            'version' => '1.0.0',
            'data' => $data
        ];
        return response()->json($response, $code);
    }

    public static function success($data = [], $msg = 'Success', $code = 200)
    {
        return Helper::res($data, $msg, $code);
    }

    public static function fail($data = [], $msg = "Some thing wen't wrong!", $code = 203)
    {
        return Helper::res($data, $msg, $code);
    }

    public static function error_parse($msg)
    {
        foreach ($msg->toArray() as $key => $value) {
            foreach ($value as $ekey => $evalue) {
                return $evalue;
            }
        }
    }

    public static function DefultdisplayProfilePath()
    {
        return URL::to('/') . '/assets/admin/user/default.jpg';
    }

    public static function displayNoImagePath()
    {
        return URL::to('/') . '/assets/admin/user/default-no-image.jpg';
    }

    public static function imageUploadPath()
    {
        return storage_path('app/public/image/');
    }

    public static function displayimagePath()
    {
        return URL::to('/') . '/storage/image/';
    }

}
