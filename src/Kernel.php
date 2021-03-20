<?php

namespace Library\Circulation;

use Library\Circulation\Common\Application\Date\Builder\DateBuilderInterface;
use Library\Circulation\Common\Application\Date\Builder\DateTimeBuilderInterface;
use Library\Circulation\Common\Application\Date\DateTimeFactory;
use Library\Circulation\Common\Infrastructure\Date\DateBuilder;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function boot()
    {
        parent::boot();
        $this->setDateAdapter();
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/services.yaml')) {
            $container->import('../config/services.yaml');
            $container->import('../config/{services}_'.$this->environment.'.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/config/services.php')) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/routes.yaml')) {
            $routes->import('../config/routes.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }

    protected function setDateAdapter(): void
    {
        $date = new class() extends Common\Application\Date\DateFactory {
            public static function setAdapter(DateBuilderInterface $adapter): void
            {
                parent::setAdapter($adapter);
            }
        };

        $date::setAdapter(new DateBuilder());
        unset($date);

        $dateTime = new class() extends DateTimeFactory {
            public static function setAdapter(DateTimeBuilderInterface $adapter): void
            {
                parent::setAdapter($adapter);
            }
        };

        $dateTime::setAdapter(new DateTimeBuilder());
        unset($dateTime);
    }
}
