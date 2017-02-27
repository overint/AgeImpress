<?php namespace App;

class Routes
{
    static function get()
    {
        return [
            '/' => 'HomeController@index',
            '/api/calculate' => 'ApiController@calculate',
            '/api/history' => 'ApiController@history',
        ];
    }
}