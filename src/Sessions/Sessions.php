<?php
namespace Eraasoft\Core\Sessions;
use Eraasoft\Core\Contracts\Sessions\SessionsContract;
use Eraasoft\Core\Environment\Env;
use ErrorException;
use Exception;

class Sessions implements SessionsContract{
    
    //check if session not working then run it 
    public static function StartSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    //check session type if it (session or cookie)
    public static function Type():string {
        return Env::getEnv('SESSION_TYPE'); 
    }
    
    //set session or cookie value
    public static function Set(string $key,mixed $value,int $time=60*60*24, string $path='/'):void
    {
        $sessionType = self::Type(); 
        if ($sessionType == 'session') {
            self::StartSession(); 
            $_SESSION[$key] = $value;
        }else if ($sessionType == 'cookie'){
            setcookie($key , $value , time()+$time , $path); 
        }            
    }
    
    //get specific key from [seesion or cookie] 
    public static function Get(string $key):mixed
    {
        $sessionType = self::Type();
        if ($sessionType == 'session') {
            self::StartSession();
            return (isset($_SESSION[$key])) ? $_SESSION[$key] : throw new ErrorException("\$_SESSION['$key'] is not Exist. "); 
        }else if ($sessionType == 'cookie'){
            return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : throw new ErrorException("\$_COOKIE['$key'] is not Exist. ");
        }
        return ''; 
    }

    //destroy specific key from session or cookie
    public static function Destroy(string $key=''):void
    {
        $sessionType = self::Type(); 
        if ($sessionType == 'session'){
            self::StartSession(); 
            if (empty($key)){
                session_destroy();
            } else {
                unset($_SESSION[$key]); 
            }
        }else if ($sessionType == 'cookie'){
            if (empty($key)) {
                foreach ($_COOKIE as $key_=>$value){
                    setcookie($key_, '', time() - 3600,'/');
                }
            } else {
                setcookie($key, '', time() - 3600,'/');
            }
        }
    }
}