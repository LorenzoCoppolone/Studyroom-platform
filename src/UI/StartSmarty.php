<?php

namespace UI;

class StartSmarty
{
    public static function configuration()
    {
        $bootstrapPath = dirname(__DIR__, 2) . '/config/bootstrap-Smarty.php';

        return require $bootstrapPath;
    }
}