<?php

include "header.php";

use \App\Controllers\UserController;
use \App\Helpers\AuthValidation;
require "../app/Helpers/AuthValidation.php";
require "../app/Controllers/UserController.php";

$userController = new UserController();


$fname = $lname = $email = $password = $confpassword = $responseMessage = '';
$authKeys = ['fname', 'lname', 'email', 'password', 'confpassword'];
$credentials = [];
$initialErrorArray = [
    'fname' => '',
    'lname' => '',
    'email' => '',
    'password' => '',
    'confpassword' => '',
    'inputErrors' => 0
];
$errorArray = $initialErrorArray;

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === 'POST')
{
    if (array_key_exists('confpassword', $_POST)) {
        $auth = 'registration';
    } else {
        $auth = 'login';
    }

    //collect auth credentials
    foreach($authKeys as $key) {
        if(array_key_exists($key, $_POST)) {
            $credentials[$key] = $_POST[$key];
        }
    }

    // validate auth inputs
    $errorArray = $initialErrorArray;
    $errorArray = (new AuthValidation)->validateCredentials($credentials, $errorArray);

    //valid credentials
    if (!$errorArray['inputErrors'] >= 1) {
        if ($auth === 'registration') {
            $response = $userController->addNewUser(
                $credentials['fname'],
                $credentials['lname'],
                $credentials['email'],
                $credentials['password']
            );
        } elseif ($auth === 'login') {
            $response = $userController->userLogin(
                $credentials['email'],
                $credentials['password']
            );
        }
        $responseMessage = $response['message'];
        $_SESSION["token"] = $response['data'];
        // $_SESSION["user"] = $response['data']['user']->id;      // remove when jwt is fixed
        $_SESSION["logged_in"] = true;
        header("Location: home");
    }
}