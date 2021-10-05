<?php

namespace HowlingWind\Libraries;

use Exception;

/**
 * Main app class
 * Deconstructs url and loads appropriate controller
 * 
 */
class Main
{
    private string $controllerNamespace = 'HowlingWind\\Controllers\\';
    private string $controllerName = 'Pages';
    protected object $currentController;
    protected string $currentMethod = 'index';
    protected array $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        try {
            // Search controllers for first value
            if (file_exists(__DIR__ . '/../controllers/' . ucwords($url[0]) . '.php')) {
                // if found set controller name
                $this->controllerName = ucwords($url[0]);
                // Clear controller name from url array
                unset($url[0]);
            }
        } catch (Exception $e) {
            //TODO - log error
        }


        // Instantiate the controller
        $fqn = $this->controllerNamespace . $this->controllerName;
        $this->currentController = new $fqn;

        // Get method from next url part
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Clear method name from url array
                unset($url[1]);
            }
        }

        // Get remaining url parts as paramaters
        $this->params = $url;

        // Invoke callback with paramaters array
        call_user_func([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(): array
    {
        $url = [];
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = explode('/', trim(strtok($_SERVER['REQUEST_URI'], '?'), '/'));
        }
        return $url;
    }
}
