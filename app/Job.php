<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['title', 'description', 'location', 'company', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}