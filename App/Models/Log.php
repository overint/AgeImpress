<?php namespace App\Models;

use PDO;

class Log extends Model
{
    public function saveLog($name, $dob, $data)
    {
        $name = $this->sanitiseHTML($name);
        $data = json_encode($data);
        $sth = $this->dbh->prepare("INSERT INTO `logs`(`name`, `dob`, `data`) VALUES (:name , :dob, :data)");
        $sth->bindParam(":name", $name);
        $sth->bindParam(":dob", $dob);
        $sth->bindParam(":data", $data);
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

}