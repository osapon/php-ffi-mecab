<?php

namespace MeCab\FFI;

use FFI;
use FFI\CData;

class Util
{
    public static function toCString(string $str, bool $owned = true): CData
    {
        $length = strlen($str);
        if(PHP_VERSION_ID >= 80300) {
            $cString = FFI::cdef()->new(sprintf('char[%d]', $length + 1), $owned);
        } else {
            $cString = FFI::new(sprintf('char[%d]', $length + 1), $owned);
        }
        FFI::memcpy($cString, $str, $length);
        $cString[$length] = "\0";

        return $cString;
    }
}
