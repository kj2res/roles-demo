<?php

namespace App\Http\Controllers;

class UserJobController extends Controller
{
    /**
     * Add user job
     * @param Job $job
     */
    public function addJob(Job $job)
    {
        auth()->user()->jobs()->attach($job->id);
    }

    /**
     * Removes user job
     * @param Job $job
     */
    public function removeJob(Job $job)
    {
        auth()->user()->jobs()->detach($job->id);
    }
}