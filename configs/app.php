<?php
    $config['app'] = [
        'service' => [
            HtmlHelper::class,
        ],
        'routeMiddleWare' => [
            'account' => AuthMiddleWare::class,
            'viewcart' => AuthMiddleWare::class,
            'account/order/' => AuthMiddleWare::class,
            'account/cancel_order/' => AuthMiddleWare::class,
            'account/logout' => AuthMiddleWare::class,
            'checkout' => AuthMiddleWare::class,
        ],
        'globalMiddleWare' => [
            ParamsMiddleWare::class,
        ],
        'boot' => [
            AppServiceProvider::class,
        ],
    ];
?>