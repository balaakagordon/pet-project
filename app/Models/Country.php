<?php

class Country {
    private $conn;
    private $table = 'countries';

    public $id;
    public $name;
    public $alpha2_code;
    public $alpha3_code;
    public $states;

    private function __construct($db)
    {
        $this->conn = $db;
        $this->conn->createCountriesTable();
    }

    public function createCountriesTable()
    {
        $stmt = "CREATE TABLE IF NOT EXISTS countries (
            country_id UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            code VARCHAR(30) NOT NULL";
        $data = $this->db->prepare($stmt);
        $data->execute();
    }

    public function getCountries()
    {
        $stmt = 'SELECT * FROM ' . $this->table;
        $data = $this->conn->prepare($stmt);
        $data->execute();
        return $data->fetch();
    }
}