<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 09.02.18
 * Time: 16:26
 */

try {
    \Bitrix\Main\Loader::registerAutoLoadClasses('local.upload', [
        'LocalUpload\LocalUpload' => 'lib/LocalUpload.php',
        'LocalUpload\PlainUtils' => 'lib/PlainUtils.php',
        'LocalUpload\RemoteUpload' => 'lib/RemoteUpload.php'
    ]);
} catch (\Bitrix\Main\LoaderException $e) {
    echo $e->getMessage();
}