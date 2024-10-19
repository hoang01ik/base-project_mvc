<?php

class Router {
    private $routers = [];
    public function add($router,$params = []){
        // $router = trim($router,'/');
        $router = preg_replace('/\//','\\/',$router);
        $router = '/^'.$router.'$/i';
        $this->routers[$router] = $params;
    }

    public function match($url) {
        foreach ($this->routers as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                array_shift($matches);
                $params['params'] = $matches;
                return $params;
            }
        }
        return false;
    }
    public function dispatch($url) {
        if($url == 'index.php'){
            $url = '/';
        }
        try {
            $url = trim($url, '/');
            $params = $this->match($url);
            // print_r($params);
            if ($params) {
                $controller = $this->convertToCamelCase($params['controller']);
                // print_r($controller);
                $controller = 'App\Controllers\\' . $controller;
    
                if (class_exists($controller)) {
                    $controller_object = new $controller();
                    $action = $this->convertToCamelCase($params['action'], false);
                    if (method_exists($controller_object, $action)) {
                        call_user_func_array([$controller_object, $action], $params['params'] ?? []);
                    } else {
                        echo "Method $action not found.";
                    }

                } else {
                    echo "Controller $controller not found.";
                }
            } else {
                // print_r($url);
                echo "No route matched.";
                // $errorController = new ErrorController();
                // $errorController->index('No route matched.' );
                // header("Location: /error");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    private function convertToCamelCase($string, $capitalizeFirst = true) {
        $string = str_replace('_', '', ucwords($string, '_'));
        if (!$capitalizeFirst) {
            $string = lcfirst($string);
        }
        return $string;
    }
}