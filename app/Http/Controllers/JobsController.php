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
        $jobs = Job::all();
        return view('home', ['jobs' => $jobs]);
    }

    /**
     * Create new job post
     * @param StoreJob $request
     * @return mixed
     */
    public function store(StoreJob $request)
    {
        $this->authorize('create', Job::class);
        return Job::create($request->all());
    }

    /**
     * Approves job post
     * @param Job $job
     * @return Job
     */
    public function update(Job $job)
    {
        $this->authorize('create', $job);

        $job->status = 'approved';
        $job->save();

        return $job;
    }
}