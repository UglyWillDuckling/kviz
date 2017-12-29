<?php
namespace App\Helper;

use Storage as LaravelStorage;


class Storage {
    const PUBLIC_PATH = '/public/';


    public static function existsInPublicStorage($public_storage_url)
    {
        $storage_path = self::getStoragePathFromUrl($public_storage_url);
        return LaravelStorage::exists($storage_path);
    }

    public static function getStoragePathFromUrl($public_storage_url)
    {
        return str_replace('storage', 'public', $public_storage_url);

    }

    public static function copyFromTemp($fileName, $dest = '')
    {
        $temp_path = self::getTempPath($fileName);
        if (LaravelStorage::exists($temp_path)) {
            return LaravelStorage::copy(
                $temp_path,
                self::PUBLIC_PATH . $dest . '/' . $fileName
            );
        }
        return false;
    }

    public static function deleteFromTemp($fileName) {
        $temp_path = self::getTempPath($fileName);
        if (LaravelStorage::exists($temp_path))
        {
            return LaravelStorage::delete($temp_path);
        }
        return false;
    }

    public static function copyToTemp($storage_path)
    {
        if (LaravelStorage::exists($storage_path)) {
            return LaravelStorage::copy(
                $storage_path,
                self::PUBLIC_PATH . pathinfo($storage_path, PATHINFO_BASENAME)
            );
        }
        return false;
    }

    public static function getTempPath($fileName) {
        return self::PUBLIC_PATH . 'temp/'  . $fileName;
    }

    public static function copyFromUrlToTempStorage($public_storage_url)
    {
        $storage_path = self::getStoragePathFromUrl($public_storage_url);
        return self::copyToTemp($storage_path);
    }
}