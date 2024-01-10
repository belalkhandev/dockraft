<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkLogRequest;
use App\Repositories\ProjectRepository;
use App\Repositories\WorkLogRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkLogController extends Controller
{
    public function __construct(
        protected WorkLogRepository $logRepository,
        protected ProjectRepository $projectRepository
    )
    {
    }

    public function index(): \Inertia\Response
    {
        $logs = $this->logRepository->getLatestByPaginate(limit: 10, with: ['project']);
        $projects = $this->projectRepository->getAll();

        return Inertia::render('WorkLog/Index', [
            'work_logs' => $logs,
            'projects' => $projects,
        ]);
    }

    public function show($workLogRef)
    {
        $log = $this->logRepository->query()
            ->with('project')
            ->ofRef($workLogRef)
            ->firstOrFail();

        return Inertia::render('WorkLog/Show', [
            'log'  => $log
        ]);
    }

    public function store(WorkLogRequest $request)
    {
        $this->logRepository->storeByRequest($request);

        return to_route('work-log.index');
    }

    public function update(WorkLogRequest $request, $workLogRef)
    {
        $this->logRepository->updateByRequest($request, $workLogRef);

        return to_route('work-log.index');
    }
}
