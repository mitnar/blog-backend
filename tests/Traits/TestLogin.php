<?php

namespace Tests\Traits;

trait TestLogin
{
    public function login()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'alisha65@example.com',
            'password' => 'password'
        ]);

        return $response;
    }
}
