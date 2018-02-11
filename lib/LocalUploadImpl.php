<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 09.02.18
 * Time: 16:52
 */

use Bitrix\Main\SystemException;
use Bitrix\Main\Application;

require_once __DIR__ . '/interfaces/LocalUpload.php';

class LocalUploadImpl implements LocalUpload
{
    protected $requestVarName = 'queryUrl';

    protected $requestUrl;
    protected $requestFileInfo;

    protected $db;
    protected $request;
    /**
     * LocalUploadImpl constructor.
     * @throws SystemException
     */
    public function __construct()
    {
        $this->db = Application::getConnection();
        $this->request = Application::getInstance()->getContext()->getRequest();

        $this->parseUrl($this->request->getQuery($this->requestVarName));
    }


    /**
     * Парсим урл на составляющие части
     * @param $urlQuery string весь url
     */
    function parseUrl($urlQuery)
    {
        $this->requestUrl = $urlQuery;
        $this->requestFileInfo = pathinfo($this->requestUrl);
    }

    /**
     * Поиск id файла в локальной базе данных по url
     * @param $fileName string название файла
     * @return integer
     */
    function findFileIDByPath($fileName)
    {
        // TODO: Implement findFileIDByPath() method.
    }

    /**
     * Ищет пользовательские свойства File
     * @return array id => name
     */
    function findPropertyIDs()
    {
        // TODO: Implement findPropertyIDs() method.
    }

    /**
     * Поиск элементов, в которых записан файл
     * @param $fileID integer id файла
     * @return array
     */
    function findElementsByFileID($fileID)
    {
        // TODO: Implement findElementsByFileID() method.
    }

    /**
     * Собирает основные свойства, необходимые для поиска их на удаленном сервере
     * @param $arElements array
     * @return array массив, который будет запрашиваться у удаленного сервера.
     */
    function getMainElementsInfo($arElements)
    {
        // TODO: Implement getMainElementsInfo() method.
    }

    /**
     * Сохранение полученных изменений.
     * @return boolean
     */
    function save()
    {
        // TODO: Implement save() method.
    }

    /**
     * Удаляем запись о старом файле.
     * @param $fileID
     * @return mixed
     */
    function eraseOldFileInfo($fileID)
    {
        // TODO: Implement eraseOldFileInfo() method.
    }

    function getRequestDirName() {
        return $this->requestFileInfo['dirname'];
    }

    function getRequestBaseName() {
        return $this->requestFileInfo['basename'];
    }

    function getRequestExtension() {
        return $this->requestFileInfo['extension'];
    }

    function getRequestFileName() {
        return $this->requestFileInfo['filename'];
    }
}