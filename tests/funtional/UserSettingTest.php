<?php
use Laracasts\Integrated\Extensions\Selenium as IntegrationTest;
use Laracasts\Integrated\Services\Laravel\Application as Laravel;

class UserSettingTest extends IntegrationTest
{
    protected $baseUrl = 'http://mixed.dev';

    public function testCreateUser()
    {
        $user = [
            'name' => 'Joe Du',
            'email' => 'joe@gmail.com',
            'password' => 'password',
        ];

        $this->visit('/users')
            ->type('n_vasit@hotmail.com', 'email')
            ->type('12345', 'password')
            ->click('sign_in')
            ->seePageIs('/users')
            ->click('#create', 'a')
            ->type($user['name'], '#input-name')
            ->type($user['email'], '#input-email')
            ->type($user['password'], '#input-password')
            ->click('#user-create')
            ->wait(2000)
            ->see($user['name'])
            ->see($user['email'])
            ->wait(3000);
    }
}
