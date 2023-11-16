<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit818247aa4a0cb2b59fb287ca79943a43
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'ClanCats\\Station\\PHPServer\\' => 27,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ClanCats\\Station\\PHPServer\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit818247aa4a0cb2b59fb287ca79943a43::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit818247aa4a0cb2b59fb287ca79943a43::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit818247aa4a0cb2b59fb287ca79943a43::$classMap;

        }, null, ClassLoader::class);
    }
}
