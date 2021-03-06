<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit660cdf649b5b0bbd70be4df6042088ad
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Moip\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Moip\\' => 
        array (
            0 => __DIR__ . '/..' . '/moip/moip-sdk-php/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'org\\bovigo\\vfs' => 
            array (
                0 => __DIR__ . '/..' . '/mikey179/vfsStream/src/main/php',
            ),
        ),
        'R' => 
        array (
            'Requests' => 
            array (
                0 => __DIR__ . '/..' . '/rmccue/requests/library',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit660cdf649b5b0bbd70be4df6042088ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit660cdf649b5b0bbd70be4df6042088ad::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit660cdf649b5b0bbd70be4df6042088ad::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
