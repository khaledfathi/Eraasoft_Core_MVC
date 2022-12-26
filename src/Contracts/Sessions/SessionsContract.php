<?php
namespace Eraasoft\Core\Contracts\Sessions;

interface  SessionsContract {
    public static function Type():string;
    public static function Set(string $key,mixed $value,int $time, string $path):void;
    public static function Get(string $key):mixed;
    public static function Destroy(string $key):void;
} 