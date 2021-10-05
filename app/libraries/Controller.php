<?php

namespace HowlingWind\Libraries;

use Exception;

/**
 * Base controller
 * Loads models and views
 */
class Controller
{
    // Load model
    public function model($model)
    {
        return new $model;
    }

    // Render view
    public function view($view, $data = [])
    {
        if (file_exists(__DIR__ . '/../views/' . $view . '.php')) {
            $v = new View(__DIR__ . '/../views/' . $view . '.php');
            $v->render($data);
        } else {
            // TODO - handle better
            die('view does not exist');
        }
    }
}
