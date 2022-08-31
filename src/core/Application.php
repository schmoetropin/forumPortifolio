<?php
declare(strict_types=1);

namespace Src\Core;

class Application
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Controller
     */
    public Controller $controller;

    /**
     * @var Route
     */
    public Route $route;

    /**
     * @var ConfigurableRoutePath
     */
    private ConfigurableRoutePath $routePath;
    
    /**
     * @var Session
     */
    private Session $session;

    /**
     * @var Application
     */
    public static Application $app;

    public function __construct() {
        $this->request = new Request();
        $this->routePath = new ConfigurableRoutePath();
        $this->route = new Route($this->request, $this->routePath);
        $this->controller = new Controller();
        $this->session = new Session();
        self::$app = $this;
    }

    /**
     * @return void
     */
    public function resolve(): void
    {
        echo $this->route->accessRoutes();
    }
}