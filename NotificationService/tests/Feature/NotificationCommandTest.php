<?php

namespace Tests\Feature;

use App\Services\NotifyService;
use Mockery;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use App\Console\Commands\NotifyCommand;
use App\Jobs\LogUserDataJob;
use App\Jobs\LogUserNotifyJob;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationCommandTest extends TestCase
{

    /**
     * Test to check that user data is loggeed on reciept of message
     * @return void
     */
    public function test_to_log_user_data_by_log_user_notify_job() {
            Queue::fake();

            $notifyService = new NotifyService();
            $notifyService->channel->basic_consume($notifyService->queueName, '', false, true, false, false, $notifyService->callback());

            $notifyService->channel->wait();

            Queue::assertPushed(LogUserNotifyJob::class);
            Queue::assertCount(1);
    }
}
