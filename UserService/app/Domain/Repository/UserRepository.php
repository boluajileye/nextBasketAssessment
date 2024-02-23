<?php

namespace App\Domain\Repository;

use App\Models\User;
use App\Domain\DTO\UserRequestDto;

interface UserRepository{

    /**
     * Insert User Object into Database
     * @param App\Domain\DTO\UserRequestDto $userRequestDto
     * @return App\Models\User
     */
    public function save(UserRequestDto $userRequestDto): User;
}
?>
