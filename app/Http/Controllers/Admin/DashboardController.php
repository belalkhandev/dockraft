<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(
    ) {
    }

    public function index()
    {
        return Inertia::render('Dashboard', [

        ]);
    }
}
