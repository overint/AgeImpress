<?php namespace App\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Exception;

class ApiController extends Controller
{
    public function calculate()
    {
        if (empty($_POST)){ $this->abort(405); }

        if (isset($_POST['name']) && isset($_POST['dob']))
        {

            if (! preg_match('/((?|19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])/', $_POST['dob']))
            {
                $this->returnJson([
                    'success' => false,
                    'error' => 'Invalid DOB'
                ]);
            }

            // Lets not reinvent the wheel :)
            $now = Carbon::now();
            $dob = new Carbon($_POST['dob']);

            $data = [
                'years' => $dob->diffInYears($now),
                'months' => $dob->diffInMonths($now),
                'days' => $dob->diffInDays($now),
                'hours' => $dob->diffInHours($now)
            ];

            $log = new Log($this->dbh);
            $log->saveLog($_POST['name'], $_POST['dob'], $data);

            $this->returnJson([
                'success' => true,
                'years' => $dob->diffInYears($now),
                'months' => $dob->diffInMonths($now),
                'days' => $dob->diffInDays($now),
                'hours' => $dob->diffInHours($now)
            ]);

        } else {
            $this->abort(400);
        }
    }

    public function history()
    {
        $log = new Log($this->dbh);
        $this->returnJson($log->getLogs());

    }
}