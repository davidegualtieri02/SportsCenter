<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d6999de6234cff9f949beecf8168aea
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
        '538ca81a9a966a6716601ecf48f4eaef' => __DIR__ . '/..' . '/opis/closure/functions.php',
        '07d7f1a47144818725fd8d91a907ac57' => __DIR__ . '/..' . '/laminas/laminas-diactoros/src/functions/create_uploaded_file.php',
        'da94ac5d3ca7d2dbab84ce561ce72bfd' => __DIR__ . '/..' . '/laminas/laminas-diactoros/src/functions/marshal_headers_from_sapi.php',
        '3d97c8dcdfba8cb85d3b34f116bb248b' => __DIR__ . '/..' . '/laminas/laminas-diactoros/src/functions/marshal_method_from_sapi.php',
        'e6f3bc6883e449ab367280b34158c05b' => __DIR__ . '/..' . '/laminas/laminas-diactoros/src/functions/marshal_protocol_version_from_sapi.php',
        'de95e0ac670b27c84ef8c5ac41fc1b34' => __DIR__ . '/..' . '/laminas/laminas-diactoros/src/functions/normalize_server.php',
        'b6c2870932b0250c10334a86dcb33c7f' => __DIR__ . '/..' . '/laminas/laminas-diactoros/src/functions/normalize_uploaded_files.php',
        'd02cf21124526632320d6f20b1bbf905' => __DIR__ . '/..' . '/laminas/laminas-diactoros/src/functions/parse_cookie_header.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Http\\Server\\' => 16,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
        ),
        'O' => 
        array (
            'Opis\\Closure\\' => 13,
        ),
        'L' => 
        array (
            'League\\Route\\' => 13,
            'Laminas\\Diactoros\\' => 18,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Http\\Server\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-server-handler/src',
            1 => __DIR__ . '/..' . '/psr/http-server-middleware/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Opis\\Closure\\' => 
        array (
            0 => __DIR__ . '/..' . '/opis/closure/src',
        ),
        'League\\Route\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/route/src',
        ),
        'Laminas\\Diactoros\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-diactoros/src',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d6999de6234cff9f949beecf8168aea::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d6999de6234cff9f949beecf8168aea::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7d6999de6234cff9f949beecf8168aea::$classMap;

        }, null, ClassLoader::class);
    }
}
