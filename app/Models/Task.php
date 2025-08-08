<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'tanggal',
        'status',
        'assigned_to',
        'role',
        'user_id' // ini juga WAJIB
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
