<?php

namespace App\core;

use App\config\Database;
require '../app/config/Database.php';

class BaseModel {
    public $database;
    public $db;

    public function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->connect();
    }

}