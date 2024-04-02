<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_project', 'project_id', 'user_id')->withTimestamps();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isProjectMember(User $user): bool
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function showProjectToMember(Project $project): mixed
    {
        return User::whereHas('projects', function ($query) use ($project) {
            $query->where('project_id', $project->id);
        })->get();
    }

    /**
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(ProjectTask::class);
    }
}
