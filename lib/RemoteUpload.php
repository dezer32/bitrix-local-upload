<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 12.02.18
 * Time: 1:46
 */

namespace LocalUpload;

require_once __DIR__.'/abstract/RemoteUploadAbstract.php';
require_once __DIR__.'/PlainUtils.php';

class RemoteUpload extends RemoteUploadAbstract
{
    public function __construct($mainSiteUrl)
    {
        parent::__construct($mainSiteUrl);
    }

    function requestData($requestParams)
    {
        foreach ($requestParams as $param) {
            $result = [];
            if ($response = $this->sendRequest($param)) {
                $parsedResponse = $this->parseResponse($response);
//                PlainUtils::logger($parsedResponse);
                $result = $parsedResponse;
            }
            return $result;
        }
    }

    function parseResponse($response)
    {
        return parent::parseResponse($response); // TODO: Change the autogenerated stub
    }
}