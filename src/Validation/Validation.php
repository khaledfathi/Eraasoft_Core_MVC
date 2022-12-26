<?php
namespace Eraasoft\Core\Validation; 
use Eraasoft\Core\Contracts\Validation\ValidationContract;
use Eraasoft\Core\Environment\Env; 

class Validation implements ValidationContract{
    public static function TextField(string $text): bool{
        $text = trim($text); 
        $require = Env::getEnv('TEXT_FIELD_REQUIRE'); 
        $minLength = Env::getEnv('TEXT_MIN_LENGTH'); 
        $maxLength = Env::getEnv('TEXT_MAX_LENGTH');
        if (!$require)
            return true;
        return preg_match("/^.{".$minLength.",".$maxLength."}(?!.)/i", $text); 
    }
    public static function Password(string $password):bool{
        $minLength = Env::getEnv('PASSWORD_MIN_LENGTH'); 
        $maxLength = Env::getEnv('PASSWORD_MAX_LENGTH');
        return preg_match("/^.{".$minLength.",".$maxLength."}(?!.)/i", $password); 
    }
    public static function Email(string $email):bool{
        return filter_var($email, FILTER_VALIDATE_EMAIL); 
    }
}