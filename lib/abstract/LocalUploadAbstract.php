<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 11.02.18
 * Time: 20:36
 */

namespace LocalUpload;

use Bitrix\Main\FileTable;

require_once __DIR__ . '/../interfaces/LocalUploadInterface.php';

abstract class LocalUploadAbstract implements LocalUploadInterface
{

    protected $requestUrl;
    protected $requestFileInfo;

    public function __construct($queryUrl)
    {
        $this->parseUrl($queryUrl);
    }

    function parseUrl($urlQuery)
    {
        $this->requestUrl = $urlQuery;
        $this->requestFileInfo = pathinfo($this->requestUrl);
    }

    function getRequestDirName()
    {
        return $this->requestFileInfo['dirname'];
    }

    function getRequestBaseName()
    {
        return $this->requestFileInfo['basename'];
    }

    function getRequestExtension()
    {
        return $this->requestFileInfo['extension'];
    }

    function getRequestFileName()
    {
        return $this->requestFileInfo['filename'];
    }

    function findFileIDByPath($fileName = null) {
        if ($fileName == null) {
            return $this->getRequestFileName();
        }
        return $fileName;
    }

    abstract function findPropertyIDs();

    abstract function findElementsByFileID($fileID);

    abstract function getMainElementsInfo($arElements);

    abstract function save();

    abstract function eraseOldFileInfo($fileID);
}