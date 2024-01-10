<?php

namespace App\Observers;

use App\Models\WorkLog;
use Illuminate\Support\Str;

class WorkLogObserver
{
    public function creating(WorkLog $model): void
    {
        do{
            $model->ref = mb_strtoupper(Str::random(10));
        }while(WorkLog::where('ref', $model->ref)->first());
    }
}
