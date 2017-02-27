<?php namespace App\Models;


class Model
{
    protected $table = '';
    protected $dbh;

    function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    protected function sanitiseHTML($html)
    {
        return htmlentities($html);
    }
}