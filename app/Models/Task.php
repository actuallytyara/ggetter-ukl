<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_id',
        'habit_id',
        'user_id',
        'judul',
        'tanggal',
        'priority',
        'status',
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
