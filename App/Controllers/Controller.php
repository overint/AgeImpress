<?php

namespace App\Controllers;

class Controller
{
    protected $dbh;

    function __construct($dbh)
    {
        $this->dbh  = $dbh;
    }


    public function returnJson($data)
    {
        header('Content-Type: application/json');
        die(json_encode($data));
    }

    public function returnHTML($data)
    {
        die($data);
    }

    public function returnView($view, $viewdata)
    {
        global $data;
        $data = $viewdata;
        require dirname(APP_ROOT) . '/views/' .  $view . '.php';
    }


    public function abort($err_code)
    {
        switch ($err_code) {
            case 400:
                http_response_code(400);
                die('400 Bad Request');
            case 404:
                http_response_code(405);
                die('404 Not Found');
            case 405:
                http_response_code(405);
                die('405 Method Not Allowed');
            default:
                http_response_code(500);
                die('500 Error');
        }
    }
}