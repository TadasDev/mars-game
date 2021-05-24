<?php

namespace Core;

use Controller\Index;
use Core\Request;

class Router
{
    public function loadPage()
    {
        $request = new Request();
        $path = $request->getPathInfo();

        $urlParams = $this->parseUrl($path);
        $controllerClass = $urlParams['class'];
        $method = $urlParams['method'];
        $param = $urlParams['param'];
        $controller = new $controllerClass;
        $controller->$method($param);
    }

    private function parseUrl($path)
    {
        $urlParams = [
            'class' => $this->getControllerClass('index'),
            'method' => 'index',
            'param' => null
        ];
        if ($path) {
            $path = trim($path, '/');
            $path = explode('/', $path);
            if (isset($path[0])) {
                $urlParams['class'] = $this->getControllerClass($path[0]);
                if (isset($path[1])) {
                    $urlParams['method'] = $path[1];
                    if (!method_exists($urlParams['class'], $urlParams['method'])) {
                        $urlParams['class'] = $this->getControllerClass('error');
                        $urlParams['method'] = 'index';
                    }
                    if(isset($path[2])){
                        $urlParams['param'] = $path[2];
                    }
                }
            }
        }
        return $urlParams;
    }

    private function getControllerClass($name)
    {
        return '\Controller\\' . ucfirst($name);
    }

}
