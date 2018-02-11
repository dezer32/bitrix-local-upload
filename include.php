<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 09.02.18
 * Time: 16:26
 */

try {
    \Bitrix\Main\Loader::registerAutoLoadClasses('uploadlocal', [
        'LocalUploadImpl' => 'lib/LocalUploadImpl.php'
    ]);
} catch (\Bitrix\Main\LoaderException $e) {
    echo $e->getMessage();
}