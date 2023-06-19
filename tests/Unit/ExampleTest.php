<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Traits\TestLogin;

class ExampleTest extends TestCase
{
    use TestsLogin;
    /**
     * A basic test example.
     */
    public function test_that_login_is_ok(): void
    {
        $response = $this->login();

        $response->assertStatus(200);
    }

    public function test_get_posts(): void
    {
        $response = $this->login();

        $token = $response->baseResponse->original['token'];

        // Использование токена авторизации в запросе
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->get('/api/posts');

        $response->assertStatus(200);
        $this->assertIsArray($response->baseResponse->poriginal['token']);
    }
}
