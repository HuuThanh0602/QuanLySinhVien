<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AutoSendResult extends Command
{
    protected $signature = 'schedule:sendResult';
    protected $description = 'Gửi kết quả sinh viên qua email';

    public function handle()
    {
        while (true) {
            Artisan::call('schedule:run');
            sleep(60);
        }
    }
}
