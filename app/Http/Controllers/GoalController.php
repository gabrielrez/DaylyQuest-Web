<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function create($collection_id)
    {
        $collection = Collection::findOrFail($collection_id);

        return view('goals.goals-create', [
            'collection' => $collection
        ]);
    }

    public function store($collection_id)
    {
        request()->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);

        Goal::create([
            'title' => request('title'),
            'description' => request('description'),
            'status' => request('status'),
            'collection_id' => $collection_id,
        ]);

        return redirect("/collection/{$collection_id}");
    }

    public function setStatus(Goal $goal)
    {
        $goal->setStatus();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $goal = Goal::findOrFail($id);
        $goal->delete();

        return redirect()->back();
    }
}
