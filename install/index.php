<?php

use Bitrix\Main\ModuleManager;

class uploadlocal extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_ID = 'uploadlocal';
        $this->MODULE_NAME = 'LocalUpload';
        $this->MODULE_DESCRIPTION = 'Local folder upload';
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = '';
        $this->PARTNER_URI = '';
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function doUninstall()
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}
