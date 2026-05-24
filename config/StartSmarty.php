<?php

namespace Config;

class StartSmarty
{
    public static function configuration()
    {
        return require __DIR__ . '/bootstrap-Smarty.php';
    }
}
