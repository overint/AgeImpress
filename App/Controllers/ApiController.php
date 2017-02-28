<?php namespace App\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Exception;

class ApiController extends Controller
{
    public function calculate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){ $this->abort(405); }
        $json = json_decode(file_get_contents('php://input'));

        if (isset($json->name) && isset($json->dob))
        {

            if (! preg_match('/((?|19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])/', $json->dob))
            {
                $this->returnJson([
                    'success' => false,
                    'error' => 'Invalid DOB'
                ]);
            }

            $log = new Log($this->dbh);

            if ($log->checkLogs($json->name))
            {
                $this->returnJson([
                    'success' => false,
                    'error' => 'Name already checked!'
                ]);
            }

            // Lets not reinvent the wheel :)
            $now = Carbon::now();
            $dob = new Carbon($json->dob);

            if ($dob->isFuture())
            {
                $this->returnJson([
                    'success' => false,
                    'error' => 'You have not been born yet!'
                ]);
            }

            $data = [
                'years' => $dob->diffInYears($now),
                'months' => $dob->diffInMonths($now),
                'days' => $dob->diffInDays($now),
                'hours' => $dob->diffInHours($now)
            ];

            //In case you wanted code w/o libraries

            $nowAlt = time();
            $dobAlt = strtotime($json->dob);
            $diff = $nowAlt - $dobAlt;


            $dataAlt = [
                'years' => floor($diff / (60 * 60 * 24 * 365)),
                'months' => floor($diff / (60 * 60 * 24 * 30)),
                'days' => floor($dobAlt / (60 * 60 * 24)),
                'hours' => floor($diff / (60 * 60))
            ];


            $log->saveLog($json->name, $json->dob, $data['years'], $data['months'], $data['days'], $data['hours']);

            $this->returnJson([
                'success' => true,
            ] + $data);

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