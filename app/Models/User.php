<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Avatar\Avatar;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getImageURL(): \Illuminate\Foundation\Application|string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }
        return 'https://ui-avatars.com/api/?name=' . $this->name;
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'user_project', 'user_id', 'project_id')->withTimestamps();
    }

    public function project(): HasMany
    {
        return $this->hasMany(Project::class, 'creator_id');
    }

    /**
     * @param User $user
     * @return User
     */
    public function showProjectToMember(User $user): User
    {
        return User::whereHas('projects', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
    }
}
