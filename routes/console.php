<?php

use Illuminate\Support\Facades\Schedule;
use App\Jobs\SendResultJob;

Schedule::job(new SendResultJob());
