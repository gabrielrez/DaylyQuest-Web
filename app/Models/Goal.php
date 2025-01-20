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
        'collection_id',
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
        $this->update(
            [
                'status' => $this->status === 'inProgress'
                    ? 'completed'
                    : 'inProgress'
            ]
        );
    }

    public function complete(): void
    {
        if ($this->status === 'completed') {
            return;
        }

        $this->update(['status' => 'completed']);

        $this->steps()->update(['status' => 'completed']);
    }

    public function uncomplete(): void
    {
        if ($this->status != 'completed') {
            return;
        }

        $this->update(['status' => 'inProgress']);

        $this->steps()->update(['status' => 'inProgress']);
    }
}
