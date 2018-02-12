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
    protected $mainSiteUrl;

    public function __construct($mainSiteUrl)
    {
        $this->mainSiteUrl = $mainSiteUrl;
    }

    function requestData($requestParams)
    {
        return $requestParams;
    }

    function parseResponse($response)
    {
        return $response;
    }

    protected function sendRequest($data) {
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, 'https://'.$this->mainSiteUrl.'/api/RemoteUpload/');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            $out = curl_exec($curl);
            curl_close($curl);

            return $out;
        }
        return false;
    }
}