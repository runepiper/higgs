<?php

namespace RP\Higgs\Utility;

/**
 * This is just a very basic routing utility that finds a matching
 * configuration for a given route. @TODO: Add more detailed description
 */
class RoutingUtility
{
    use SingletonTrait;

    public static function resolveRoute(string $uri): array
    {
        $compiledRoutingData = self::compileRoutingData();
        $result = [];

        if (preg_match($compiledRoutingData['regex'], $uri, $matches)) {
            $result = $compiledRoutingData['mapping'][$matches['MARK']];
        }

        if (empty($result)) {
            http_response_code(404);
            throw new \Exception('Couldn\'t resolve ' . $_SERVER['REQUEST_URI']);
            die();
        }

        return $result;
    }

    protected static function compileRoutingData(): array
    {
        $regex = '~^(?|';
        $routeMap = [];
        $i = 0;
        $config = ConfigUtility::load();

        // Build regex expression for matching the requested url
        // @see http://nikic.github.io/2014/02/18/Fast-request-routing-using-regular-expressions.html
        // @see https://medium.com/@nicolas.grekas/making-symfonys-router-77-7x-faster-1-2-958e3754f0e1
        foreach ($config['routes'] as $uri => $config) {
            $regex .= '(*MARK:route' . $i . ')';
            $regex .= preg_replace('/{([A-Za-z]*?)}/', '(\d+)', $uri);
            $regex .= '|';
            $routeMap['route' . $i] = $config;
            $i++;
        }

        $regex .= ')$~x';

        return [
            'regex' => $regex,
            'mapping' => $routeMap
        ];
    }
}