<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
