<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routing): void {
    $routing->import(
        [
            'path' => 'Controllers/',
            'namespace' => 'App\Rates\Controllers'
        ],
        'attribute',
    );
};