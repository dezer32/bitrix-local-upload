<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 11.02.18
 * Time: 20:54
 */

namespace LocalUpload;

require_once __DIR__ . '/abstract/LocalUploadAbstract.php';

use Bitrix\Main\Application;
use Bitrix\Main\FileTable;

class LocalUpload extends LocalUploadAbstract
{
    protected $requestVarName = 'queryUrl';

    protected $db;
    protected $request;

    /**
     * LocalUpload constructor.
     */
    public function __construct()
    {
        $this->db = Application::getConnection();
        $this->request = Application::getInstance()->getContext()->getRequest();

        parent::__construct($this->request->getQuery($this->requestVarName));
    }

    function findFileIDByPath($fileName = null)
    {
        $fileName = parent::findFileIDByPath($fileName);
        $parameters = [
            'filter' => [
                'FILE_NAME' => $fileName
            ],
            'select' => [
                'ID'
            ]
        ];
        $queryFileID = FileTable::getList($parameters);

        return $queryFileID->fetch();
    }

    function findPropertyIDs()
    {
        // TODO: Implement findPropertyIDs() method.
    }

    function findElementsByFileID($fileID)
    {
        // TODO: Implement findElementsByFileID() method.
    }

    function getMainElementsInfo($arElements)
    {
        // TODO: Implement getMainElementsInfo() method.
    }

    function save()
    {
        // TODO: Implement save() method.
    }

    function eraseOldFileInfo($fileID)
    {
        // TODO: Implement eraseOldFileInfo() method.
    }
}