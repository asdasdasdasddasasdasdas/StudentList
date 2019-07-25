<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbba05eb2a09bbce510d3c563f55a4c15
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'StudentList\\' => 12,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'StudentList\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbba05eb2a09bbce510d3c563f55a4c15::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbba05eb2a09bbce510d3c563f55a4c15::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
