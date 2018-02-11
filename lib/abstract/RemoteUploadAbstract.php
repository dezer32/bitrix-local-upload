<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 12.02.18
 * Time: 1:47
 */

namespace LocalUpload;

require_once __DIR__.'/../interfaces/RemoteUploadInterface.php';

class RemoteUploadAbstract implements RemoteUploadInterface
{
    function requestData($requestParams)
    {
        // TODO: Implement requestData() method.
    }

    function parseRequest($response)
    {
        // TODO: Implement parseRequest() method.
    }
}