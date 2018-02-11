<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 11.02.18
 * Time: 20:54
 */

namespace LocalUpload;

require_once __DIR__ . '/abstract/LocalUploadAbstract.php';

use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\Template\Entity\ElementProperty;
use Bitrix\Main\Application;
use Bitrix\Main\FileTable;
use Bitrix\Main\Loader;

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
        Loader::includeModule('iblock');

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
        $fileID = $queryFileID->fetch();
        return $fileID['ID'];
    }

    function findPropertyIDs()
    {
        // TODO: Implement findPropertyIDs() method.
        $parameters = [
            'filter' => [
                'PROPERTY_TYPE' => PropertyTable::TYPE_FILE
            ],
            'select' => [
                'ID',
                'CODE'
            ]
        ];
        $propTable = PropertyTable::getList($parameters);

        return $propTable->fetchAll();
    }

    private function findElementsByFileIDFromMainProperty($fileID) {
        $parameters = [
            'filter' => [
                'LOGIC' => 'OR',
                'DETAIL_PICTURE' => $fileID,
                'PREVIEW_PICTURE' => $fileID
            ],
            'select' => [
                'ID',
                'CODE',
                'IBLOCK_ID',
                'IBLOCK_SECTION_ID',
                'DETAIL_PICTURE',
                'PREVIEW_PICTURE'
            ]
        ];
        $elemTable = ElementTable::getList($parameters);

        return $elemTable->fetchAll();
    }

    private function findElementsByFileIDFromOtherProperty($fileID) {
        $parameters = [];
        $propTable = PropertyTable::getList($parameters);

        return $propTable->fetchAll();
    }

    function findElementsByFileID($fileID)
    {
//        $mainProp = $this->findElementsByFileIDFromMainProperty($fileID);
        $otherProp = $this->findElementsByFileIDFromOtherProperty($fileID);

        return $otherProp;
        return array_merge($mainProp, $otherProp);
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