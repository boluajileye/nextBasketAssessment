<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to check that user store in database
     */
    public function test_users_endpoint_store_user_data(): void
    {
        $data = (new UserFactory())->definition();

        $response = $this->post('/users', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'email',
                'firstName',
                'lastName',
            ])
            ->assertJson($data);

        $this->assertDatabaseHas('users', $data);
        $this->assertDatabaseCount('users', 1);
    }

        /**
     * A test to check that user store validation response
     */
    public function test_users_endpoint_validate_user_data(): void
    {
        $data = [
            'email'     => 'test@user.com'
        ];

        $response = $this->post('/users', $data);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors',
            ])
            ->assertJsonValidationErrors(['firstName', 'lastName']);

        $this->assertDatabaseMissing('users', $data);
        $this->assertDatabaseCount('users', 0);
    }
}
