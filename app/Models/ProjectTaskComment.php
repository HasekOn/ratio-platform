<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectTaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_task_id',
        'user_id',
        'content',
    ];

    /**
     * @return BelongsTo
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(ProjectTask::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param int $userId
     * @return string|null
     */
    public function getUserNameById(int $userId): string|null
    {
        $user = User::find($userId);
        if ($user) {
            return $user->name;
        } else {
            return null;
        }
    }

    /**
     * @param int $userId
     */
    public function getUserImageById(int $userId)
    {
        $user = User::find($userId);
        if ($user->image) {
            return url('storage/' . $user->image);
        } else {
            return 'https://ui-avatars.com/api/?name=' . $user->name;
        }
    }
}
