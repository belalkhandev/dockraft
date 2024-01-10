<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectRepository $projectRepository
    )
    {
    }

    public function index(): \Inertia\Response
    {
        $projects = $this->projectRepository->getLatestByPaginate();

        return Inertia::render('Project/Index', [
            'projects' => $projects,
            'statuses' => ProjectStatus::values()
        ]);
    }

    public function store(ProjectRequest $request)
    {
        $this->projectRepository->storeByRequest($request);

        return to_route('project.index');
    }

    public function update(ProjectRequest $request, $projectRef)
    {
        $this->projectRepository->updateByRequest($request, $projectRef);

        return to_route('project.index');
    }
}
