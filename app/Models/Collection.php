<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = ['title', 'description', 'limit_time', 'status', 'points'];
}
