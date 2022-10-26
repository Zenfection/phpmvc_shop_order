<?php
    $config['app'] = [
        'service' => [
            HtmlHelper::class,
        ],
        'routeMiddleWare' => [
            'account' => AuthMiddleWare::class,
        ],
        'globalMiddleWare' => [
            ParamsMiddleWare::class,
        ],
        'boot' => [
            AppServiceProvider::class,
        ],
    ];
?>