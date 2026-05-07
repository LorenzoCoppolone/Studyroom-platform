<?php

namespace Foundation;

use Model\Studente;
use Doctrine\Common\Collections\ArrayCollection;
class Session {

    private static $data = [];

    public static function set($key, $value) {
        self::$data[$key] = $value;
    }

    public static function get($key) {
        return self::$data[$key] ?? null;
    }

    public static function remove($key) {
        unset(self::$data[$key]);
    }

    public static function destroy() {
        self::$data = [];
    }

    // simulazione utente loggato
    public static function getUser() {
        if (!isset(self::$data['user'])) {
            $user = new Studente(1, "", "", "", "", "", true,);
            $user->setId(1);
            $user->setNome("TestUser");
            self::$data['user'] = $user;
        }
        return self::$data['user'];
    }
}