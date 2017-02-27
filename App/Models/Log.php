<?php namespace App\Models;

use PDO;

class Log extends Model
{
    public function saveLog($name, $dob, $years, $months, $days, $hours)
    {
        $name = $this->sanitiseHTML($name);
        $sth = $this->dbh->prepare("INSERT INTO `logs`(`name`, `dob`, `years`, `months`, `days`, `hours`) VALUES (:name , :dob, :years, :months, :days, :hours)");
        $sth->bindParam(":name", $name);
        $sth->bindParam(":dob", $dob);
        $sth->bindParam(":years", $years);
        $sth->bindParam(":months", $months);
        $sth->bindParam(":days", $days);
        $sth->bindParam(":hours", $hours);
        $sth->execute();
    }

    public function getLogs($count = 10)
    {
        $sth = $this->dbh->prepare("SELECT * FROM `logs` ORDER BY `created_at` DESC LIMIT :count");
        $sth->bindParam(":count", $count, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_OBJ);

    }

    public function countLogs()
    {
        $sth = $this->dbh->prepare("SELECT COUNT(*) FROM `logs`");
        $sth->execute();
        $sth->execute();
        return $sth->fetch()[0];

    }

    public function checkLogs($name)
    {
        $sth = $this->dbh->prepare("SELECT COUNT(*) FROM `logs` WHERE `name` = :name");
        $sth->bindParam(":name", $name);
        $sth->execute();
        return $sth->fetch()[0] > 0 ? true : false;

    }

}