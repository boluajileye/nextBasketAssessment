<?php
namespace App\Services;

use App\Domain\DTO\UserRequestDto;
use App\Jobs\NotificationEventJob;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\UserStoreRequest;
use App\Domain\Repository\EloquentUserRepository;

class UserService{

    public function __construct(protected EloquentUserRepository $userRepository)
    {
    }

    /**
     * Service class function to store user data in db and log
     *
     * @param UserStoreRequest $request
     * @return UserResource
     */
    public function saveUser(UserStoreRequest $request): UserResource {
        $user = $this->userRepository->save(new UserRequestDto($request->validated()));

        info("Inserted User Data", $user->toArray());

        NotificationEventJob::dispatch($user);

        return UserResource::make($user);
    }
}
?>
