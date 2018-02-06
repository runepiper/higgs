<?php

namespace RP\Higgs\Utility;

trait SingletonTrait
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

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
