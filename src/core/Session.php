<?php
declare(strict_types=1);

namespace Src\Core;

class Session
{
    public function __construct()
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setSession(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return void
     */
    public function unsetSession(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * @param string $key
     * @return string mixed
     */
    public function getSession(string $key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }
}