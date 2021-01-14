<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf8b324da97fd102ae74f9048356f0a99
{
    public static $files = array (
        'f2d2f44c4a007ed5e7bb044890632360' => __DIR__ . '/..' . '/crazy-max/cws-dump/lib/Cws/CwsDumpHelper.php',
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Cws' => 
            array (
                0 => __DIR__ . '/../..' . '/lib',
                1 => __DIR__ . '/..' . '/crazy-max/cws-dump/lib',
                2 => __DIR__ . '/..' . '/crazy-max/cws-debug/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitf8b324da97fd102ae74f9048356f0a99::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}