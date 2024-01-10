<?php

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Str;

class ProjectObserver
{
    public function creating(Project $model): void
    {
        do{
            $model->ref = mb_strtoupper(Str::random(10));
        }while(Project::where('ref', $model->ref)->first());
    }
}
