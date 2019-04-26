<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user = [
        'first_name' => 'test',
        'last_name' => 'user',
        'email' => 'testuser@email.com',
        'password' => 'Password!',
        'is_active' => true,
        'role' => 'user'
    ];

    protected function setup()
    {
        parent::setup();
    }
    public function __construct()
    {
        //
    }

    public function testRegisterUser()
    {
        $this->assertTrue(false);
    }

    public function testLoginUser()
    {
        //
    }
}