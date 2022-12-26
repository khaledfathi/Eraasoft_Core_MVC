<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit20d5b2dac567e47cc83c82c13f4aaa20
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Eraasoft\\Core\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Eraasoft\\Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit20d5b2dac567e47cc83c82c13f4aaa20::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit20d5b2dac567e47cc83c82c13f4aaa20::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit20d5b2dac567e47cc83c82c13f4aaa20::$classMap;

        }, null, ClassLoader::class);
    }
}
