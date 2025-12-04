<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'duration_minutes',
        'published',
    ];

    // --- AGREGA ESTO ---
    public function students()
    {
        // Asumiendo que tu tabla pivote se llama 'course_user'
        return $this->belongsToMany(User::class);
    }
}