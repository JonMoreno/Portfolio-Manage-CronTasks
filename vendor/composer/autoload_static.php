<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit11dc7949d43a942a00eb30f4720d8245
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Cron\\Tests\\' => 11,
            'Cron\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Cron\\Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'Cron\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit11dc7949d43a942a00eb30f4720d8245::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit11dc7949d43a942a00eb30f4720d8245::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}