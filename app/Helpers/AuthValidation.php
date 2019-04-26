<?php

namespace App\Helpers;

class AuthValidation
{

    public function validateCredentials($credentials, $errorArray)
    {
        $errorArray = $this->confirmPassword($credentials, $errorArray);
        if(array_key_exists('confpassword', $errorArray) && !$errorArray['confpassword'] == '') {
            return $errorArray;
        } else {
            foreach($credentials as $key=>$value) {
                switch ($key) {
                    case 'fname':
                        $errorArray = $this->validateName($key, $value, $errorArray);
                        break;
                    case 'lname':
                        $errorArray = $this->validateName($key, $value, $errorArray);
                        break;
                    case 'email':
                        $errorArray = $this->validateEmail($key, $value, $errorArray);
                        break;
                    case 'password':
                        $errorArray = $this->validatePassword($key, $value, $errorArray);
                        break;
                    case 'confpassword':
                        $errorArray = $this->validatePassword($key, $value, $errorArray);
                        break;
                    default:
                        break;
                }
            }
        }
        return $errorArray;
    }

    public function validateName($key, $name, $array)
    {
        $nameType = ($key === 'fname' ?
            'first' : 'last');

        if (strlen($name) <= 1 || !preg_match("/^([a-zA-Z' ]+)$/", $name)) {
            $array[$key] = 'Please enter a valid ' . $nameType . ' name';
            $array['inputErrors']++ ;
        }
        return $array;
    }

    public function validateEmail($key, $email, $array)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            null;
        } else {
            $array[$key] = 'Please enter a valid email address';
            $array['inputErrors']++ ;
        }
        return $array;
    }

    public function validatePassword($key, $password, $array)
    {
        if (strlen($password) <= 7) {
            $array[$key] = 'Your password must contain at least 8 characters';
            $array['inputErrors']++ ;
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $array[$key] = 'Your password must contain at least 1 number';
            $array['inputErrors']++ ;
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $array[$key] = 'Your password must contain at least 1 upper-case letter';
            $array['inputErrors']++ ;
        } elseif (!preg_match("#[a-z]+#", $password)) {
            $array[$key] = 'Your password must contain at least 1 lower-case letter';
            $array['inputErrors']++ ;
        }
        return $array;
    }

    public function confirmPassword($credentials, $array)
    {
        if(array_key_exists('confpassword', $credentials)) {
            if ($credentials['confpassword'] !== $credentials['password']) {
                $array['confpassword'] = 'Please confirm your password again';
                $array['inputErrors']++ ;
            }
        }
        return $array;
    }
}

