<?php

namespace App\Models;

use Carbon\Carbon;
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
        'collection_id',
        'completed_at',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function setStatus(): void
    {
        $this->status === 'inProgress'
            ? $this->complete()
            : $this->uncomplete();
    }

    protected function complete(): void
    {
        $this->update(
            [
                'status' => 'completed',
                'completed_at' => Carbon::now()    
            ]
        );

        $this->steps()->update(['status' => 'completed']);
    }

    protected function uncomplete(): void
    {
        $this->update(
            [
                'status' => 'inProgress',
                'completed_at' => null    
            ]
        );

        $this->steps()->update(['status' => 'inProgress']);
    }
}
