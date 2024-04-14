<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'user_id',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $user_id
     * @param $project_id
     * @param string $remember_token
     * @return mixed
     */
    public function getInvitation($user_id, $project_id, string $remember_token)
    {
        return Invitation::where('user_id', $user_id)
            ->where('project_id', $project_id)
            ->where('remember_token', $remember_token)
            ->first();
    }
}
