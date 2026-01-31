<?php

if (!function_exists('Str')) {
    class Str
    {
        public static function limit($string, $limit = 100, $end = '...')
        {
            if (strlen($string) <= $limit) {
                return $string;
            }

            return rtrim(substr($string, 0, $limit)) . $end;
        }
    }
}