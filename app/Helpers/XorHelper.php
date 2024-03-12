<?php

namespace App\Helpers;

class XorHelper
{
    public static function xor($data)
    {
        $message = preg_split('//u', $data, -1, PREG_SPLIT_NO_EMPTY);
        $key = [53, 75, 118, 82, 109, 119, 88, 121, 46, 51, 54, 83, 117, 38, 90, 122, 107, 53];
        $result = array_fill(0, count($message), 0);

        for ($i = 0; $i < count($message); $i++) {
            $message[$i] = ord($message[$i]);
        }

        for ($i = 0; $i < count($message); $i++) {
            $result[$i] = $message[$i] ^ $key[$i % count($key)];
        }

        return implode('', array_map('chr', $result));
    }
}
