<?php

namespace Feature\Project;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use DatabaseMigrations;


    public function test_user_can_login()
    {
        $password = fake()->password;
        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
            'remember' => fake()->boolean,
        ];

        $response = $this->post('/login', $data);

        $response->assertStatus(200);

        // Assert that the response contains a token and user data
        $response->assertJson(fn (AssertableJson $json) =>
        $json->has('data.token')
            ->where('data.user.email', $user->email));

        $this->assertAuthenticatedAs($user, 'api');
    }
}
