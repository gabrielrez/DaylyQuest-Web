<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'status', 
        'points'
    ];

    public function collection(){
        return $this->belongsTo(Collection::class);
    }
}
