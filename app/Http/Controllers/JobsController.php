<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJob;
use App\Job;

class JobsController extends Controller
{
    public function index()
    {
        return Job::all();
    }

    public function store(StoreJob $request)
    {
        $this->authorize('create', Job::class);
        return Job::create($request->all());
    }

    public function approve(Job $job)
    {
        if (!auth()->user()->hasPermissionTo('approve job')) {
            abort(403, 'Unauthorized action.');
        }

        $job->status = 'approved';
        $job->save();

        return $job;
    }
}