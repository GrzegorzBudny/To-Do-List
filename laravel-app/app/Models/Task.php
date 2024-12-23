<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'priority', 'status', 'due_date', 'user_id', 'token', 'token_expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {   
        return $this->hasMany(TaskHistory::class);
    }

}