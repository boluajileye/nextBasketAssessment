<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Domain\DTO\UserRequestDto;
use App\Jobs\NotificationEventJob;
use App\Services\MessagingService;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domain\Repository\EloquentUserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageJobTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test to check for message notificattion pushed to queue
     * @return void
     */
    public function test_that_notification_job_is_dispatched()
    {
        Queue::fake();

        $data = (new UserFactory())->definition();

        $this->post('/users', $data);

        Queue::assertPushed(NotificationEventJob::class);
        Queue::assertCount(1);
    }

}
