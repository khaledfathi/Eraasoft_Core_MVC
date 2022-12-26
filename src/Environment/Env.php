<?php
namespace Eraasoft\Core\Environment;
use Eraasoft\Core\Contracts\Environment\EnvironmentContract;
use Exception; 

class Env implements  EnvironmentContract{
    //read Config/Env Variables from config.json [live on /src/config.json]
    public static function loadConfig(): array{
        if(file_exists("config.json")){
            $JsonContent = file_get_contents("config.json",true);
            return json_decode($JsonContent , true);
        }else{
            throw new Exception('Target file "config.json" dosen\'t exist. '); 
        }  
    }

    //get specific value from config file [config.json]
    public static function getEnv(string $key): mixed{
        $content =   self::loadConfig();
        if (!count($content)) return ''; 
        if(array_key_exists($key,$content)){
            return $content[$key];
        } else {
            throw new Exception("Key $key dosen't exist! ");
        }
    }
}