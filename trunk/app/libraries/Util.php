<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 8/4/13
 * Time: 1:16 PM
 * To change this template use File | Settings | File Templates.
 */

class Util
{

    public static function convertToAbsoluteURL($filePath)
    {
        try {
            $path = base_path();
            $path = dirname(dirname($path));
            return $path . '/public/' . ltrim($filePath, "/");
        } catch (Exception $e) {
            Log::error($e);
        }
    }


    public static function getParentUrl($value)
    {
        return dirname($value);
    }

    public static function getFileExtension($file)
    {
        $info = new SplFileInfo($file);
        return $info->getExtension();
    }


    public static function pre_login()
    {
        Session::put('pre_login', URL::current());
    }


    public static function getCurrentUTCDateTime()
    {
        return new DateTime('now', new DateTimeZone('UTC'));
    }

    public static function getCurrentUTCTimeString()
    {
        $temp = new DateTime('now', new DateTimeZone('UTC'));
        return $temp->format("Y-m-d H:i:s");
    }

    public static function getDateTimeInString(DateTime $dateTime)
    {
        return $dateTime->format("Y-m-d H:i:s");
    }

    public static function GUID()
    {

        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }


    public static function getPreviousDate($date)
    {
        return date('Y-m-d', strtotime('-1 day', strtotime($date)));
    }


    public static function getIncrementedDate($days = 0)
    {
        return date('Y-m-d', strtotime("+1 $days", strtotime(date('Y-m-d'))));
    }
}