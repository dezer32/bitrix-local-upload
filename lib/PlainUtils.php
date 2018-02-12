<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 12.02.18
 * Time: 10:09
 */

namespace LocalUpload;


class PlainUtils
{
    static function logger($data, $otherData = null) {
        echo '<pre>'.print_r($data, true).'</pre>';
        if ($otherData != null) {
            self::logger($otherData);
        }
    }
}