<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'description',
        'status',
        'goal_id',
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function setStatus(): void
    {
        $this->update(
            [
                'status' => $this->status === 'inProgress'
                    ? 'completed'
                    : 'inProgress'
            ]
        );
    }
}
