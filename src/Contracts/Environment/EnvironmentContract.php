<?php
namespace Eraasoft\Core\Contracts\Environment;

interface EnvironmentContract{
    public static function loadConfig():array;
    public static function getEnv(string $key):mixed;
}