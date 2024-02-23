<?php

namespace App\Domain\DTO;

use App\Http\Requests\User\UserStoreRequest;

class UserRequestDto{
    /**
     * Private Email property
     * @var string
     */
    private String $email;

    /**
     * Private First Name Property
     * @var string
     */
    private String $firstName;

    /**
     * Private Last Name Property
     * @var string
     */
    private String $lastName;

    /**
     * UserRequestDto constructor populate class parameters
     * @param App\Http\Requests\User\UserStoreRequest $request
     */
    public function __construct(UserStoreRequest $request) {
        $this->email = $request->validated('email');
        $this->firstName = $request->validated('firstName');
        $this->lastName = $request->validated('lastName');
    }

    /**
     * Get Value of Email
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Get value of First Name
     * @return string
     */
    public function getFirstName(): string {
        return $this->firstName;
    }

    /**
     * Get value of Last Name
     * @return string
     */
    public function getLastName(): string {
        return $this->lastName;
    }
}

?>
