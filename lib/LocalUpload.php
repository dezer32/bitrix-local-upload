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
use Bitrix\Main\Application;
use Bitrix\Main\FileTable;
use Bitrix\Main\Loader;

class LocalUpload extends LocalUploadAbstract
{
    protected $requestVarName = 'queryUrl';

    protected $db;
    protected $request;

    private $propertyIDs;

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

    function findElementsByFileID($fileID)
    {
        $result = $this->findElementsByFileIDFromMainProperty($fileID);
        $otherProp = $this->findElementsByFileIDFromOtherProperty($fileID);
        if (!empty($result)) {
            $result = array_merge($result, $otherProp);
        } else {
            $result = $otherProp;
        }
        return $result;
    }

    function getPropertyIDs()
    {
        if (empty($this->propertyIDs)) {
            $this->propertyIDs = $this->findPropertyIDs();
        }
        return $this->propertyIDs;
    }

    function findPropertyIDs()
    {
        $parameters = [
            'filter' => [
                'PROPERTY_TYPE' => PropertyTable::TYPE_FILE
            ],
            'select' => [
                'ID',
                'CODE',
                'IBLOCK_ID'
            ]
        ];
        $propTable = PropertyTable::getList($parameters);
        return $this->propertyIDs = $propTable->fetchAll();
    }

    private function findElementsByFileIDFromMainProperty($fileID)
    {
        $parameters = [
            'filter' => [
                'LOGIC' => 'OR',
                'DETAIL_PICTURE' => $fileID,
                'PREVIEW_PICTURE' => $fileID,
            ],
            'select' => [
                'ID',
                'IBLOCK_ID',
                'DETAIL_PICTURE',
                'PREVIEW_PICTURE'
            ]
        ];
        $elemTable = ElementTable::getList($parameters);
        return $this->parseMainProp($elemTable->fetchAll());
    }

    private function findElementsByFileIDFromOtherProperty($fileID)
    {
        $propertyIDs = $this->getPropertyIDs();
        $propertyIDs = array_column($propertyIDs, 'ID');
        $queryPropertyIDs = implode(',', $propertyIDs);
        $sql = 'select ep.IBLOCK_ELEMENT_ID as ID, 
                       ep.IBLOCK_PROPERTY_ID as PROP_ID 
                from b_iblock_element_property as ep 
                WHERE ep.VALUE = "' . $fileID . '" AND ep.IBLOCK_PROPERTY_ID in (' . $queryPropertyIDs . ');';
        $elemProp = $this->db->query($sql);
        return $this->parseOtherProp($elemProp->fetchAll());
    }

    private function parseMainProp($properties)
    {
        $result = [];
        foreach ($properties as $property) {
            $item = [
                'elementID' => $property['ID'],
                'iblockID' => $property['IBLOCK_ID']
            ];
            if (!empty($property['DETAIL_PICTURE'])) {
                $item['propertyName'] = 'DETAIL_PICTURE';
            } else {
                $item['propertyName'] = 'PREVIEW_PICTURE';
            }
            $result[] = $item;
        }
        return $result;
    }

    private function parseOtherProp($properties)
    {
        $result = [];
        foreach ($properties as $property) {
            $propertyInfo = $this->getPropertyInfoById($property['PROP_ID']);
            $result[] = [
                'elementID' => $property['ID'],
                'iblockID' => $propertyInfo['IBLOCK_ID'],
                'propertyName' => $propertyInfo['CODE']
            ];
        }
        return $result;
    }

    private function getPropertyInfoById($id)
    {
        $properties = $this->getPropertyIDs();
        $key = array_search($id, array_column($properties, 'ID'));
        return $properties[$key];
    }
}