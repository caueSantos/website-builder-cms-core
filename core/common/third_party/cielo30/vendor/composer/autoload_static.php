<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd4b4cac1d58ab18f2c00d60414549576
{
    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Cielo' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitd4b4cac1d58ab18f2c00d60414549576::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}