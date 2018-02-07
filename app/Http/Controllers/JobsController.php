<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJob;
use App\Job;

class JobsController extends Controller
{
    /**
     * Get all job posts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $jobs = Job::query();

        if (auth()->user()->hasPermissionTo('approve job')) {
            $jobs = $jobs->where('status', 'pending');
        } else {
            $jobs = $jobs->where('status', 'approved');
        }

        return view('home', [
            'jobs' => $jobs->get(),
            'canCreateJob' => auth()->user()->can('create', Job::class) ? 'true' : 'false',
            'canApply' => auth()->user()->hasPermissionTo('apply job') ? 'true' : 'false',
            'canApprove' => auth()->user()->hasPermissionTo('approve job') ? 'true' : 'false',
        ]);
    }

    /**
     * Create new job post
     * @param StoreJob $request
     * @return mixed
     */
    public function store(StoreJob $request)
    {
        $this->authorize('create', Job::class);

        $attributes = $request->all();
        $attributes['status'] = 'pending';

        return Job::create($attributes);
    }

    /**
     * Approves job post
     * @param Job $job
     * @return Job
     */
    public function update(Job $job)
    {
        $this->authorize('update', $job);

        $job->status = 'approved';
        $job->save();

        return $job;
    }
}