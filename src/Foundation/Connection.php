<?php

require_once "config.php";

class Connection {

    private static $conn = null;

    public static function getConnection() {

        global $hostname, $dbname, $user, $pass;

        if (self::$conn === null) {

            try {
                self::$conn = new PDO(
                    "mysql:host=$hostname;dbname=$dbname",
                    $user,
                    $pass
                );

                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Connessione fallita: " . $e->getMessage());
            }
        }

        return self::$conn;
    }
}
?>