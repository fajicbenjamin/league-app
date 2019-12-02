<?php


namespace App\Http;


use Exception;
use Illuminate\Support\Facades\File;

class RiotConstants
{
    public static function getSeason(int $seasonId) {
        $path = public_path() . '/json/seasons.json';

        return self::openFile($path)[$seasonId];
    }

    public static function getQueue(int $queueId) {
        $path = public_path() . '/json/maps.json';

        return self::openFile($path);
    }

    private static function openFile(string $path) {
        if (!File::exists($path)) {
            return null;
        }

        return json_decode(File::get($path));
    }
}