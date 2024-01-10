<?php

namespace App\Repositories;

use App\Models\WorkLog;
use Illuminate\Http\Request;

class WorkLogRepository extends Repository
{
    public function model()
    {
        return WorkLog::class;
    }

    public function storeByRequest(Request $request)
    {
        return $this->query()->create([

        ]);
    }

    public function updateByRequest(Request $request, $workLogId)
    {
        return $this->query()->findOrFail($workLogId)?->update([

        ]);
    }

    public function deleteByRequest($workLogId)
    {
        return $this->query()->findOrFail($workLogId)?->delete();
    }

}
