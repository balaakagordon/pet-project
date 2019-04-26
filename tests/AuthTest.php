<?php

use \App\Helpers\AuthValidation;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    protected function setup()
    {
        parent::setUp();
        $this->authValidation = new AuthValidation();
        $this->errArray = ['inputErrors' => 0];
        $this->user = [
            'fname' => 'test',
            'last_name' => 'user',
            'email' => 'testuser@email.com',
            'password' => 'Password!',
            'confpassword' => 'Password!'
        ];
    }

    public function testFirstNameInvalidInput()
    {
        $key = 'fname';
        $actual = $this->authValidation->validateName($key, 't', $this->errArray);
        $this->errArray[$key] = 'Please enter a valid first name';
        $this->errArray['inputErrors']++ ;
        $this->assertEquals($actual, $this->errArray);
    }

    public function testLastNameInvalidInput()
    {
        $key = 'lname';
        $actual = $this->authValidation->validateName($key, 'u', $this->errArray);
        $this->errArray [$key] = 'Please enter a valid last name';
        $this->errArray['inputErrors']++ ;
        $this->assertEquals($actual, $this->errArray);
    }

    public function testFirstNameValidInput()
    {
        $key = 'fname';
        $actual = $this->authValidation->validateName($key, 'test', $this->errArray);
        $this->assertEquals($actual, $this->errArray);
    }

    public function testEmailInvalidInput()
    {
        $key = 'email';
        $actual = $this->authValidation->validateEmail($key, 'someemailstring.com', $this->errArray);
        $this->errArray[$key] = 'Please enter a valid email address';
        $this->errArray['inputErrors']++ ;
        $this->assertEquals($actual, $this->errArray);
    }

    public function testEmailValidInput()
    {
        $key = 'email';
        $actual = $this->authValidation->validateEmail($key, 'testuser@email.com', $this->errArray);
        $this->assertEquals($actual, $this->errArray);
    }

    public function testPasswordNoUpperCase()
    {
        $key = 'password';
        $actual = $this->authValidation->validatePassword($key, 'passw0rd', $this->errArray);
        $this->errArray[$key] = 'Your password must contain at least 1 upper-case letter';
        $this->errArray['inputErrors']++ ;
        $this->assertEquals($actual, $this->errArray);
    }

    public function testPasswordNoLowerCase()
    {
        $key = 'password';
        $actual = $this->authValidation->validatePassword($key, 'PASSW0RD', $this->errArray);
        $this->errArray[$key] = 'Your password must contain at least 1 lower-case letter'
        ;
        $this->errArray['inputErrors']++ ;
        $this->assertEquals($actual, $this->errArray);
    }

    public function testShortPassword()
    {
        $key = 'password';
        $actual = $this->authValidation->validatePassword($key, 'pass5', $this->errArray);
        $this->errArray[$key] = 'Your password must contain at least 8 characters';
        $this->errArray['inputErrors']++ ;
        $this->assertEquals($actual, $this->errArray);
    }

    public function testPasswordNoNumbers()
    {
        $key = 'password';
        $actual = $this->authValidation->validatePassword($key, 'passWord', $this->errArray);
        $this->errArray[$key] = 'Your password must contain at least 1 number';
        $this->errArray['inputErrors']++ ;
        $this->assertEquals($actual, $this->errArray);
    }

    public function testPasswordValidInput()
    {
        $key = 'confpassword';
        $actual = $this->authValidation->validatePassword($key, 'Passw0rd', $this->errArray);
        $this->assertEquals($actual, $this->errArray);
    }
}