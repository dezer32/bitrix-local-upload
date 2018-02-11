<?php
/**
 * Created by PhpStorm.
 * User: dezer
 * Date: 09.02.18
 * Time: 16:38
 */

interface LocalUpload
{
    /**
     * Парсим урл на составляющие части
     * @param $urlQuery string весь url
     */
    function parseUrl($urlQuery);

    /**
     * Поиск id файла в локальной базе данных по url
     * @param $fileName string название файла
     * @return integer
     */
    function findFileIDByPath($fileName);

    /**
     * Ищет пользовательские свойства File
     * @return array id => name
     */
    function findPropertyIDs();

    /**
     * Поиск элементов, в которых записан файл
     * @param $fileID integer id файла
     * @return array
     */
    function findElementsByFileID($fileID);

    /**
     * Собирает основные свойства, необходимые для поиска их на удаленном сервере
     * @param $arElements array
     * @return array массив, который будет запрашиваться у удаленного сервера.
     */
    function getMainElementsInfo($arElements);

    /**
     * Сохранение полученных изменений.
     * @return boolean
     */
    function save();

    /**
     * Удаляем запись о старом файле.
     * @param $fileID
     * @return mixed
     */
    function eraseOldFileInfo($fileID);
}