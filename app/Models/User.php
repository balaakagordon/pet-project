<?php

namespace App\Models;

use App\core\BaseModel;
require '../app/core/BaseModel.php';

class User extends BaseModel
{
    private $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $stmt = 'SELECT * FROM ' . $this->table;
        $data = $this->db->prepare($stmt);
        $data->execute();
        return $data->fetchAll();
    }

    public function getUserByEmail($email)
    {
        $stmt = 'SELECT * FROM ' . $this->table . ' WHERE email = ?';
        $data = $this->db->prepare($stmt);
        $data->execute([$email]);
        return $data->fetch();
    }

    public function getUserById($id)
    {
        $stmt = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';
        $data = $this->db->prepare($stmt);
        $data->execute([$id]);
        return $data->fetch();
    }

    public function registerUser($fname, $lname, $password, $email)
    {
        $stmt = 'INSERT INTO ' . $this->table . ' (first_name, last_name, email, password, is_active, role) VALUES (:first_name, :last_name, :email, :password, :is_active, :role)';
        $data = $this->db->prepare($stmt);
        $data->execute([
            'first_name' => $fname,
            'last_name' => $lname,
            'email' => $email,
            'password' => $password,
            'is_active' => true,
            'role' => 'user'
        ]);
        return true;
    }

    public function editActiveStatus($id, $newStatus)
    {
        $stmt = 'UPDATE ' . $this->table . ' SET is_active = :is_active WHERE id = :id';
        $data = $this->db->prepare($stmt);
        if($newStatus) {
            $data->execute([
                'is_active' => 1,
                'id' => $id
                ]);
        } else {
            $data->execute([
                'is_active' => 0,
                'id' => $id
                ]);
        }
        return true;
    }

    // public function createCountriesTable()
    // {
    //     $stmt = "CREATE TABLE IF NOT EXISTS `countries` (
    //         `country_id` INT AUTO_INCREMENT PRIMARY KEY,
    //         `name` VARCHAR(30) NOT NULL,
    //         `code` VARCHAR(30) NOT NULL)";

    //     // $data = $this->db->prepare($stmt);
    //     // $data->execute();
    //     if($this->db->query($stmt) === TRUE) {
    //         echo "Countries table created successfully";
    //     } else {
    //         echo "FAIL!!!!!!!";
    //     }
    // }

}