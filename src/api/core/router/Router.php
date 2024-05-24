<?php
namespace App\core\router;
use Exception;

class Router
{
    protected array $routes = [];
    protected array $dynamicRoutes = [];

    private function addRoute($route, $controller, $action, $method): void
    {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function get($route, $controller, $action): void
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function put($route, $controller, $action): void
    {
        $this->addRoute($route, $controller, $action, "PUT");
    }

    public function post($route, $controller, $action): void
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    // route with trailing dynamic param: `/something/{id}`
    public function routeWithParam($route, $controller, $action, $method): void
    {
        $this->dynamicRoutes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function getWithParam($route, $controller, $action): void
    {
        $this->routeWithParam($route, $controller, $action, "GET");
    }

    public function putWithParam($route, $controller, $action): void
    {
        $this->routeWithParam($route, $controller, $action, "PUT");
    }

    public function deleteWithParam($route, $controller, $action): void
    {
        $this->routeWithParam($route, $controller, $action, "DELETE");
    }

    public function postWithParam($route, $controller, $action): void
    {
        $this->routeWithParam($route, $controller, $action, "POST");
    }

    /**
     * @throws Exception
     */
    public function dispatch(): void
    {
        // Removing the prefix path in env API_PREFIX
        $prefix = getenv('API_PREFIX');

        $uri = '';
        if ($prefix) {
            $uri = substr($_SERVER['REQUEST_URI'], strlen($prefix));
        } else {
            $uri = strtok($_SERVER['REQUEST_URI'], '?');
        }
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "OPTIONS") {
            // FIXME: Only for development. Remove in production
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type');
            header('Access-Control-Max-Age: 86400');
            header('Content-Length: 0');
            header('Content-Type: text/plain');
            http_response_code(200);
            return;
        }

        header('Content-Type: application/json; charset=utf-8');

        if (array_key_exists($method, $this->routes) && array_key_exists($uri, $this->routes[$method])) {
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];

            $body_data = null;
            if ($method == "PUT" || $method == "POST") {
                $body_data = json_decode(file_get_contents('php://input'), true);
            }

            $controller = new $controller();
            $controller->$action([], $body_data);
            return;
        } else {
            $originalUri = $uri;

            // uri without the last element:
            // /topicos/{id} -> /topicos
            $uri = explode('/', $uri);
            $elem = array_pop($uri);
            $uri = implode('/', $uri);

            if (array_key_exists($method, $this->dynamicRoutes) && array_key_exists($uri, $this->dynamicRoutes[$method])) {
                $body_data = null;
                if ($method == "PUT" || $method == "POST") {
                    $body_data = json_decode(file_get_contents('php://input'), true);
                }

                $controller = $this->dynamicRoutes[$method][$uri]['controller'];
                $action = $this->dynamicRoutes[$method][$uri]['action'];

                $controller = new $controller();
                $controller->$action([$elem], $body_data);
                return;
            }
        }

        http_response_code(404);

        echo json_encode(['error' => 'No route found for uri: ' . $uri]);
    }
}

?>