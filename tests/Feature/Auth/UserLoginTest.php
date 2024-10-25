<?php

namespace Tests\Feature\Auth;

use App\Actions\LoginUserAction;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserLoginTest extends TestCase
{
    use DatabaseMigrations;

    protected string $password = 'password123';
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a default user for login tests
        $this->user = User::factory()->create([
            'password' => bcrypt($this->password),
        ]);
    }

    private function getLoginData(array $overrides = []): array
    {
        return array_merge([
            'email' => $this->user->email,
            'password' => $this->password,
        ], $overrides);
    }

    public function test_user_can_login(): void
    {
        $response = $this->postJson('/login', $this->getLoginData());

        $response->assertJson(fn (AssertableJson $json) =>
        $json->has('data.token')
            ->where('data.email', $this->user->email)
        );

        $response->assertValid();
        $this->assertAuthenticatedAs($this->user, 'api');
    }

    public function test_user_login_validation_email_fail(): void
    {
        $response = $this->postJson('/login', $this->getLoginData([
            'email' => 'invalid-email',
            'password' => 'fake password',
        ]));

        $response->assertStatus(422);
        $response->assertInvalid([
            'email' => __('validation.email', ['attribute' => __('validation.attributes.email')]),
        ]);
    }

    public function test_user_login_throw_exception(): void
    {
        $this->expectException(AuthenticationException::class);

        $data = $this->getLoginData([
            'password' => 'fake password',
        ]);

        Auth::shouldReceive('attempt')
            ->with($data)
            ->andReturn(false);

        $action = new LoginUserAction;
        $action->execute($data);
    }

    public function test_logout_attempt_by_non_logged_in_user_returns_error()
    {
        Auth::shouldReceive('logout')->once()->andThrow((new JWTException(__('auth.logout.failed_token'))));

        $response = $this->get(route('auth.logout'));

        $response->assertStatus(401)
            ->assertExactJson(['message' => __('auth.logout.failed_token')]);
    }


    public function test_successful_logout_of_logged_in_user()
    {
        Auth::shouldReceive('logout')->once()->andReturn(true);

        $response = $this->get(route('auth.logout'));

        $response->assertStatus(200)
            ->assertExactJson(['message' => __('auth.logout.successfully')]);
    }
}
