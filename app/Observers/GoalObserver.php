<?php

namespace App\Observers;

use App\Models\Goal;

class GoalObserver
{
    /**
     * Handle the Goal "created" event.
     */
    public function created(Goal $goal): void
    {
        //
    }

    /**
     * Handle the Goal "updated" event.
     */
    public function updated(Goal $goal): void
    {
        $collection = $goal->collection();

        $collection->isCompleted()
            ? $collection->updateCompletedStatus()
            : $collection->updateNotCompletedStatus();
    }

    /**
     * Handle the Goal "deleted" event.
     */
    public function deleted(Goal $goal): void
    {
        //
    }

    /**
     * Handle the Goal "restored" event.
     */
    public function restored(Goal $goal): void
    {
        //
    }

    /**
     * Handle the Goal "force deleted" event.
     */
    public function forceDeleted(Goal $goal): void
    {
        //
    }
}
