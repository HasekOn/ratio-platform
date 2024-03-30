<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'name',
        'effort',
        'timeEst',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_project', 'project_id', 'user_id')->withTimestamps();
    }

    public function isProjectMember(User $user)
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }

    public function showProjectToMember(Project $project)
    {
        return User::whereHas('projects', function ($query) use ($project) {
            $query->where('project_id', $project->id);
        })->get();
    }
}
