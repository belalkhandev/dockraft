<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\WorkLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;

class WorkLogRepository extends Repository
{
    public function model()
    {
        return WorkLog::class;
    }

    public function storeByRequest(Request $request): Model
    {
        return $this->query()->create([
            'project_id' => $request->get('project_id'),
            'summary' => $request->get('summary'),
            'description' => $request->get('description'),
            'worked_at' => $request->get('worked_at') ?? now()->format('Y-m-d'),
        ]);
    }

    public function updateByRequest(Request $request, $workLogRef): bool
    {
        return $this->query()
            ->ofRef($workLogRef)
            ->firstOrFail()
            ->update([
                'project_id' => $request->get('project_id'),
                'summary' => $request->get('summary'),
                'description' => $request->get('description'),
                'worked_at' => $request->get('worked_at') ?? now()->format('Y-m-d'),
            ]);
    }

    public function deleteByRequest($workLogId)
    {
        return $this->query()
            ->findOrFail($workLogId)
            ->delete();
    }

}
