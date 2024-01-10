<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;

class ProjectRepository extends Repository
{
    public function model()
    {
        return Project::class;
    }

    public function storeByRequest(Request $request): Model
    {
        return $this->query()->create([
            'name' => $request->get('name'),
            'key' => $request->get('key'),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
        ]);
    }

    public function updateByRequest(Request $request, $projectRef): bool
    {
        return $this->query()
            ->ofRef($projectRef)
            ->firstOrFail()
            ->update([
                'name' => $request->get('name'),
                'key' => $request->get('key'),
                'description' => $request->get('description'),
                'status' => $request->get('status'),
            ]);
    }

    public function deleteByRequest($projectId)
    {
        return $this->query()
            ->findOrFail($projectId)
            ->delete();
    }

}
