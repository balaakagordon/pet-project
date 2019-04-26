<?php

namespace App\Helpers;

use \ReallySimpleJWT\Token;

class UserService
{
    private $secret = 'Hello&GordonFooBar123';

    public function activateUser($user, $userModel, $id, callable $callback)
    {
        if (!$user->is_active) {
            $userModel->editActiveStatus($id, TRUE);
            return call_user_func(
                $callback,
                'user activated',
                http_response_code(201),
                $userModel->getUserById($id)
            );
        } else {
            return call_user_func(
                $callback,
                'user already activated',
                http_response_code(200),
                $user
            );
        }
    }

    public function checkUserExists($email, $user)
    {
        $user = $user->getUserByEmail($email);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function deactivateUser($user, $userModel, $id, callable $callback)
    {
        if ($user->is_active) {
            $userModel->editActiveStatus($id, FALSE);
            return call_user_func(
                $callback,
                'user deactivated',
                http_response_code(201),
                $userModel->getUserById($id)
            );
        } else {
            return call_user_func(
                $callback,
                'user already deactivated',
                http_response_code(200),
                $user
            );
        }
    }

    public function generateToken($user)
    {
        $payload = [
            'iat' => time(),
            'uid' => $user,
            'exp' => time() + 3600,
            'iss' => 'localhost'
        ];

        return Token::customPayload($payload, $this->secret);
    }

    public function validateToken($token)
    {
        return Token::validate($token, $this->secret);
    }

    function getTokenData($token) {
        return [
            Token::getHeader($token, $this->secret),
            Token::getPayload($token, $this->secret)
        ];
    }

    function isAuthenticated($id, $token) {
        $payload = $this->getTokenData($token)['payload'];
        if ($payload['uid'] === $id) {
            return true;
        } else {
            return false;
        }
    }
}
