<?php

namespace Opstalent\Mock\Symfony;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Patryk Grudniewski <patgrudniewski@gmail.com>
 * @package Opstalent\Mock
 */
final class Routing
{
    /**
     * @param array $routing
     * @return RouteCollection
     */
    public static function mockRouteCollection(array $routing = []) : RouteCollection
    {
        $routeCollection = \Mockery::mock(RouteCollection::class);

        $routeCollection
            ->shouldReceive('get')
            ->andReturnUsing(function($key) use ($routing) {
                if (!array_key_exists($key, $routing)) {
                    return null;
                }

                return static::mockRoute($routing[$key]);
            });

        return $routeCollection;
    }

    /**
     * @param array $options
     * @return Route
     */
    public static function mockRoute(array $options = []) : Route
    {
        $route = \Mockery::mock(Route::class);

        $route
            ->shouldReceive('getOption')
            ->andReturnUsing(function($key) use ($options) {
                if (!array_key_exists($key, $options)) {
                    return null;
                }

                return $options[$key];
            });

        return $route;
    }

    /**
     * @param callable $callback
     * @return RouterInterface
     */
    public static function mockRouterInterface(callable $callback = null) : RouterInterface
    {
        $router = \Mockery::mock(RouterInterface::class);

        $expectation = $router->shouldReceive('getRouteCollection');
        if (null !== $callback) {
            $expectation->andReturnUsing($callback);
        } else {
            $expectation->andReturn(static::mockRouteCollection());
        }

        return $router;
    }
}
