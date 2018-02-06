<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function getJobs()
    {
        $jobs = auth()->user()->jobs()->get();
        return $jobs;
    }
}