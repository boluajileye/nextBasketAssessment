<?php

namespace App\Services;

interface NotifyServiceInterface{

       /**
     * Process User information in Message Queue
     */
    public function handle(): void;
}

?>
