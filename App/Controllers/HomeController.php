<?php namespace App\Controllers;

use App\Models\Log;

class HomeController extends Controller
{
    public function index()
    {
        $log = new Log($this->dbh);
        $this->returnView('home', ['total' => $log->countLogs()]);
    }

}