<?php

namespace App\config;

class Database
{
    public $host = 'localhost';
    public $dbName = 'countries';
    public $username = 'postgres';
    public $password = '';
    public $dsn;
    public $attributes = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        // \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_EMULATE_PREPARES => false,
    ];
    public $conn;

    public function connect()
    {
        $this->db = null;
        $this->dsn = 'pgsql:host=' . $this->host . ';dbname=' . $this->dbName;
        try {
            $this->conn = new \PDO(
                $this->dsn,
                $this->username,
                $this->password,
                $this->attributes
            );
        } catch(\PDOException $err) {
            throw new \PDOException($err->getMessage(), (int)$err->getCode());
        }

        return $this->conn;
    }

    public function createSessionTable()
    {
        $stmt = "CREATE TABLE IF NOT EXISTS sessions (
            session_id bigint(20) unsigned NOT NULL auto_increment,
            user_id bigint(20) NOT NULL REFERENCES users(id),
            session_key varchar(60) NOT NULL,
            session_address varchar(100) NOT NULL,
            session_useragent varchar(200) NOT NULL,
            session_expires datetime NOT NULL default '0000-00-00 00:00:00',
            PRIMARY KEY (session_id),
            KEY idx_session_key (session_key)
            ) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    }

}
