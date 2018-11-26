<?php
namespace Generic\Database;


class Database
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $dbName;
    /**
     * @var string
     */
    private $dbUser;
    /**
     * @var string
     */
    private $dbPassword;

    public function __construct(
        string $host,
        string $dbName,
        string $dbUser,
        string $dbPassword
    ) {

        $this->host = $host;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
    }

    public function connect()
    {
        try {
            $dbh = new \PDO(
                'mysql:host='.$this->host.';dbname='.$this->dbName,
                $this->dbUser,
                $this->dbPassword,
                [
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ]
            );
            return $dbh;
        } catch (\PDOException $e) {
            return null;
        }
    }
}











