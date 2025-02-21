<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'question', 'options', 'answer'];

    protected $casts = [
        'options' => 'array', // Konversi JSON menjadi array
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
}
