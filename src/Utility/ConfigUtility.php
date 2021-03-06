<?php

namespace RP\Higgs\Utility;

class ConfigUtility extends AbstractUtility
{
    /**
     * @return array
     */
    public static function load(): array
    {
        $rootDir = substr($_SERVER['DOCUMENT_ROOT'], 0, -1) . str_replace('index.php', '', $_SERVER['PHP_SELF']);
        $config = ['rootdir' => $rootDir];

        if (file_exists($rootDir . 'config.php')) {
            $config += require $rootDir . 'config.php';
        }

        return $config;
    }
}
