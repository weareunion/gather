<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitef6d7aba7ccd8bc4f022ea78871f19e8
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rollbar\\' => 8,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rollbar\\' => 
        array (
            0 => __DIR__ . '/..' . '/rollbar/rollbar/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitef6d7aba7ccd8bc4f022ea78871f19e8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitef6d7aba7ccd8bc4f022ea78871f19e8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
