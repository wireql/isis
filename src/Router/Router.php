<?php

class Router
{
    
    private $routes = [];
    
    /**
     * Инициализация маршрута
     *
     * @return callback
     */
    public function init() {
        $path = parse_url($_SERVER['REQUEST_URI']);

        foreach ($this->routes as $route) {
            if ($route['path'] === $path['path']) {
                $callback = $route['callback'];

                if (is_callable($callback)) {

                    $callback();

                    break;
                } else {
                    $parts = explode('@', $callback);

                    $controllerName = $parts[0];
                    $methodName = $parts[1];

                    $controllerFile = __DIR__ . "/../App/Controllers/{$controllerName}.php";

                    if (file_exists($controllerFile)) {
                        require_once $controllerFile;
            
                        // Создаем экземпляр контроллера и вызываем метод
                        $controller = new $controllerName();
                        if (method_exists($controller, $methodName)) {
                            $controller->$methodName();
                            $content;
                        } else {
                            echo "Метод " . $methodName . " не найден.";
                            break;
                        }
                    } else {
                        echo "Контроллер " . $controllerName . " не найден.";
                        break;
                    }

                }
            }
        }
    }

    public function addPath($path, $callback) {

        $pathInfo = [
            "path" => $path,
            "callback" => $callback
        ];

        array_push($this->routes, $pathInfo);    
    }

    public function getRoutes() {
        return $this->routes;
    }

    public function getRoute() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['path'] === $path) {
                return $route;
            }
        }

        return null;
    }

}
