<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Retrieve all user jobs
     * @return mixed
     */
    public function getJobs()
    {
        $jobs = auth()->user()->jobs()->get();
        return $jobs;
    }
}