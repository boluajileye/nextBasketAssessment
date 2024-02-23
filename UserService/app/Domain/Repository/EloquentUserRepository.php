<?php

namespace App\Domain\Repository;
use App\Domain\Repository\UserRepository;
use App\Models\User;


class EloquentUserRepository implements UserRepository
{

    /**
     * Insert User Object into Database
     *
     * @param App\Domain\DTO\UserRequestDto|\App\Domain\DTO\UserRequestDto $userRequestDto
     * @return \App\Models\User|
     */
    public function save(\App\Domain\DTO\UserRequestDto $userRequestDto): User {
        return User::create([
            'email' => $userRequestDto->getEmail(),
            'firstName' => $userRequestDto->getFirstName(),
            'lastName' => $userRequestDto->getLastName()
        ]);
    }
}

?>
