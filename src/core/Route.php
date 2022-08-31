<?php
declare(strict_types=1);

namespace Src\Core;

class Route
{
    /**
     * @var Request
     */
    private Request $request;

    /**
     * @var ConfigurableRoutePath
     */
    private ConfigurableRoutePath $routePath;

    /**
     * @var array
     */
    private array $routes;
    
    /**
     * @param Request $request
     * @param ConfigurableRoutePath $routePath
     */
    public function __construct(Request $request, ConfigurableRoutePath $routePath)
    {
        $this->request = $request;
        $this->routePath = $routePath;
    }

    /**
     * @return void
     */
    public function get(string $path, array $callback): void
    {
        if ($path === REQ_URI_ROOT) {
            $this->routes['GET'][REQ_URI_ROOT] = $callback;
        } else {
            $this->routes['GET'][REQ_URI.$path] = $callback;
        }
    }

    /**
     * @return void
     */
    public function post(string $path, array $callback): void
    {
        $this->routes['POST'][REQ_URI.$path] = $callback;
    }

    /**
     * @return string|null
     */
    public function accessRoutes(): ?string
    {
        $method = $this->request->getRequestMethod();
        $path = $this->request->getRequestUri();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            $checkPath = str_replace([REQ_URI.'/', REQ_URI_ROOT], '', $path);
            if($checkPath === '') {
                return $this->page404();
            } else {
                $array = explode('/', $checkPath);
                if(!empty($array[1])){
                    if ($this->routePath->configurablePath($array[0], $array[1])) {
                        $registeredPath = REQ_URI.'/'.$array[0].'/'.UNIQUE_PAGE_NAME;
                        $callback = $this->routes[$method][$registeredPath];
                    } else {
                        return $this->page404();    
                    }
                } else {
                    return $this->page404();
                }
            }
        }
        return call_user_func($callback, $this->request);
    }

    /**
     * @return string
     */
    private function page404(): string
    {
        http_response_code(404);
        return Application::$app->controller->view('notFound');
    }
}