<?php

namespace App\Factory;

use App\Interfaces\Database;

class PDOFactory implements Database
{
    private string $host;
    private string $dbname;
    private string $username;
    private string $password;

    public function __construct(
                                string $host = "db",
                                string $dbname = "react",
                                string $username = "root",
                                string $password = "password"
                                )
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function getMysqlPDO(): \PDO
    {
        return new \PDO("mysql:host=". $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
    }

    public function getPostgresPDO(): \PDO
    {
        return new \PDO("mysql:host=". $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
    }

    public function getMongoPDO(): \PDO
    {
        return new \PDO("mysql:host=". $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
    }

}
