<?php

namespace RP\Higgs\Utility;

abstract class AbstractUtility
{
    /**
     * @var self
     */
    protected static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(): AbstractUtility
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}