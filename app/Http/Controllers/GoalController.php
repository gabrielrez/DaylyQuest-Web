<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Goal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GoalController extends Controller
{
    public function create(int $collection_id): View
    {
        $collection = Collection::findOrFail($collection_id);

        return view('goals.goals-create', [
            'collection' => $collection
        ]);
    }

    public function store(int $collection_id): RedirectResponse
    {
        request()->validate([
            'title' => ['required', 'max:36'],
            'description' => ['required', 'max:100'],
        ]);

        Goal::create([
            'title' => request('title'),
            'description' => request('description'),
            'status' => request('status'),
            'collection_id' => $collection_id,
        ]);

        return redirect("/collection/{$collection_id}");
    }

    public function setStatus(Goal $goal): JsonResponse
    {
        $goal->setStatus();

        return response()->json($goal);
    }

    public function destroy(int $id): RedirectResponse
    {
        $goal = Goal::findOrFail($id);
        $collection = $goal->collection;

        if ($collection->hasExpired()) {
            return redirect()->back();
        }

        $goal->delete();

        return redirect()->back();
    }
}
