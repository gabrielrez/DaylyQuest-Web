<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CollectionController extends Controller
{
    public function show($id)
    {
        $collection = Collection::find($id);

        $goals = Goal::where('collection_id', $id)->get();

        $collection_completed = $goals->isNotEmpty() && $goals->every(fn($goal) => $goal->status === 1);

        $status = $collection_completed
            ? [
                'title' => 'Congrats! 🎉',
                'message' => "You've completed this collection!",
                'status' => 'success',
            ]
            : $collection->getStatus();

        return view('collections.collection', [
            'collection' => $collection,
            'goals' => $goals,
            'deadline' => $collection->formatedDeadline(),
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('collections.collection-create');
    }

    public function store()
    {
        request()->validate([
            'title' => ['required'],
            'description' => ['required'],
            'deadline' => ['required'],
        ]);

        Collection::create([
            'title' => request('title'),
            'description' => request('description'),
            'deadline' => request('deadline'),
            'cyclic' => request('cyclic'),
            'status' => request('status'),
            'points' => request('points'),
            'user_id' => request('user_id'),
        ]);

        return redirect('/homepage');
    }
}
