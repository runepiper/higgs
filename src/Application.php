<?php

namespace RP\Higgs;

use RP\Higgs\Utility\ConfigUtility;
use RP\Higgs\Utility\RoutingUtility;

class Application
{
    /**
     * @var array
     */
    protected $config = [];

    public function __construct()
    {
        $this->config = ConfigUtility::load();
    }

    public function boot()
    {
        $route = $this->resolveRoute();
        $controller = $this->config['namespace'] . 'Controller\\' . ucfirst($route['controller']) . 'Controller';
        $action = lcfirst($route['action']) . 'Action';

        if (class_exists($controller) && method_exists($controller, $action)) {
            $arguments = array_merge(filter_input_array(INPUT_GET) ?? [], $route);

            $class = new \ReflectionClass($controller);
            $class->newInstance($arguments)->$action($arguments);
        } else {
            http_response_code(404);
            throw new \Exception('Could not resolve ' . $controller . '::' . $action);
            die();
        }
    }

    /**
     * @return array
     */
    protected function resolveRoute(): array
    {
        $requestUrl = parse_url($_SERVER['REQUEST_URI'])['path'];
        $cwd = substr($_SERVER['CWD'], 0, -1);
        $requestUrl = str_replace($cwd, '', $requestUrl);

        return RoutingUtility::resolveRoute($requestUrl);
    }
}
