<?php

namespace App\Console\Commands;

use App\Services\NotifyService;
use Illuminate\Console\Command;
use App\Services\NotifyServiceInterface;

class NotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify User on addition to Database or Log';

    /**
     * Execute the console command.
     */
    public function handle(NotifyService $notifyService)
    {
        $this->components->alert('Listening for User events.');
        info("'Listening for User events.'");
        $this->info('');
        $this->info('');

        $notifyService->handle();

    }
}
