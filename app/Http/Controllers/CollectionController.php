<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Goal;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function show($id)
    {
        $collection = Collection::find($id);

        $goals = Goal::where('collection_id', $id)->get();

        return view('collections.collection', [
            'collection' => $collection,
            'goals' => $goals,
            'deadline' => $collection->formatedDeadline(),
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
