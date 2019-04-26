<?php

namespace App\Controllers;

use \App\core\BaseController;
use \App\Models\User;
use \App\Helpers\UserService;

require '../app/core/BaseController.php';
require '../app/Models/User.php';
require '../app/Helpers/UserService.php';

class UserController extends BaseController
{
    public function __construct()
    {
        $this->user =  new User();
        $this->userService = new UserService();
    }

    public function addNewUser($fname, $lname, $email, $password)
    {
        $data = [];
        if ($this->userService->checkUserExists($email, $this->user)) {
            $responseCode = http_response_code(201);
            $msg = 'User Already exists';
        } else {
            $this->user->registerUser($fname, $lname, md5($password), $email);
            $responseCode = http_response_code(200);
            $msg = 'Successfully added';
            $user = $this->user->getUserByEmail($email);
            $data = $this->userService->generateToken($user->id);
        }
        return $this->prepareResponse($msg, $responseCode, $data);
    }

    public function getUser($id)
    {
        $data = $this->user->getUserById($id);
        if (empty($data)) {
            $msg = 'User not found';
            $responseCode = http_response_code(404);
        } else {
            $msg = '';
            $responseCode = http_response_code(200);
        }
        return $this->prepareResponse($msg, $responseCode, $data);
    }

    public function getAllUsers()
    {
        $data = $this->user->getAllUsers();
        if (empty($data)) {
            $msg = 'No users found';
        } else {
            $msg = sizeof($data) . ' users found';
        }
        $responseCode = http_response_code(200);
        return $this->prepareResponse($msg, $responseCode, $data);
    }

    public function userLogin($email, $password)
    {
        $user = $this->user->getUserByEmail($email);
        $data = [];
        if ($user->password === md5($password)) {
            $msg = 'Login successful';
            $responseCode = http_response_code(200);
            $data = $this->userService->generateToken($user->id);
        } else {
            $msg = 'Incorrect credentials';
            $responseCode = http_response_code(401);
        }
        return $this->prepareResponse($msg, $responseCode, $data);
    }

    public function toggleActiveStatus($id, $action, $token)
    {
        $user = $this->user->getUserById($id);
        $payload = $this->userService->getTokenData($token)['payload'];;
        $authenticated = $this->userService->isAuthenticated($user->id, $token);

        if ($action === 'deactivate') {
            return $this->userService->deactivateUser(
                $user,
                $this->user,
                $id,
                array($this, 'prepareResponse')
            );
        } elseif ($action === 'activate') {
            return $this->userService->activateUser(
                $user,
                $this->user,
                $id,
                array($this, 'prepareResponse')
            );
        }
    }

    public function editUserDetails($email)
    {
        //
    }
}
