<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 12.02.18
 * Time: 1:41
 */

namespace LocalUpload;


interface RemoteUploadInterface
{
    function requestData($requestParams);
    function parseRequest($response);
}