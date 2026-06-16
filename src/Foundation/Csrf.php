<?php
namespace Foundation;

/**
 * Helper per la protezione CSRF.
 *
 * Genera e conserva in sessione un token, da includere come campo nascosto
 * in tutte le form POST, e ne verifica la validità lato server.
 */
class Csrf {

    private const KEY = 'csrf_token';

    /**
     * Restituisce il token CSRF della sessione corrente, generandolo se assente.
     * @return string
     */
    public static function token(): string {
        Session::getInstance(); // assicura che la sessione sia avviata
        $token = Session::getSessionElement(self::KEY);
        if (!is_string($token) || $token === '') {
            $token = bin2hex(random_bytes(32));
            Session::setSessionElement(self::KEY, $token);
        }
        return $token;
    }

    /**
     * Verifica che il token ricevuto coincida con quello in sessione.
     * @param string|null $token Token ricevuto dalla form.
     * @return bool
     */
    public static function check(?string $token): bool {
        Session::getInstance();
        $stored = Session::getSessionElement(self::KEY);
        return is_string($stored) && is_string($token) && $token !== '' && hash_equals($stored, $token);
    }
}
