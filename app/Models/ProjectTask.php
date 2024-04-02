<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'name',
        'status',
        'effort',
        'priority',
        'timeEst',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameById(int $userId)
    {
        $user = User::find($userId);
        if ($user) {
            return $user->name;
        } else {
            return null;
        }
    }
}
