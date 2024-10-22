<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    
    protected $fillable = [
        'title', 
        'description', 
        'limit_time', 
        'status', 
        'points'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
