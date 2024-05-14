<?php

declare(strict_types=1);

namespace App\MyBusinessFeature;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $services = $di->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\Rates\\', './*')
        ->exclude('./{routing.php,di.php}');
};