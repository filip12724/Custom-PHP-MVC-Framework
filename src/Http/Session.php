<?php 

namespace Elephant\Framework\Http;

class Session 
{
    public static function start(): void 
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function get(string $key, mixed $default = null): mixed 
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function put(string $key, mixed $value): void 
    {
        $_SESSION[$key] = $value;
    }

    public static function has (string $key): bool 
    {
        return array_key_exists($key, $_SESSION);
    }

    public static function remove (string $key): void
    {
        unset($_SESSION[$key]);
    }
}