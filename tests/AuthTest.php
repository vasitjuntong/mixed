<?php

class AuthTest extends TestCase
{
    public function testLogin()
    {
        $this->visit('/auth/login')
            ->type('n_vasit@hotmail.com', 'email')
            ->type('12345', 'password')
            ->press('Sign In')
            ->see('Vasit Juntong')
            ->seePageIs('/dashboard');
    }

    public function testLoginWrongUser()
    {
        $this->visit('/auth/login')
            ->type('n_vasit@hotmail.com', 'email')
            ->type('123456', 'password')
            ->press('Sign In')
            ->see('These credentials do not match our records.');

    }
}
