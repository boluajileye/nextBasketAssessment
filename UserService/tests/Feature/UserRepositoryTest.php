<?php

namespace Tests\Feature;

use App\Domain\DTO\UserRequestDto;
use App\Domain\Repository\EloquentUserRepository;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test To check user repository can store data
     * @return void
     */
    public function test_that_user_data_can_be_stored() {

        $data = (new UserFactory())->definition();

        $userRepository = new EloquentUserRepository();

        $userRequestDto = new UserRequestDto($data);

        $user = $userRepository->save($userRequestDto);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', $data);
        $this->assertInstanceOf(UserRequestDto::class, $userRequestDto);
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * Test to check UserRequestDto::class can take parameters
     * @return void
     */
    public function test_to_check_that_user_request_dto_contain_parameters(){
        $data = (new UserFactory())->definition();

        $userRequestDto = new UserRequestDto($data);

        $this->assertInstanceOf(UserRequestDto::class, $userRequestDto);
        $this->assertSame($data['email'], $userRequestDto->getEmail());
        $this->assertSame($data['firstName'], $userRequestDto->getFirstName());
        $this->assertSame($data['lastName'], $userRequestDto->getLastName());
    }


}
