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
        $left_time = '07:43:26';

        $goals = Goal::where('collection_id', $id)->get();

        return view('collections.collection', [
            'collection' => $collection,
            'goals' => $goals,
            'left_time' => $left_time
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
            'limit_time' => request('deadline'),
            'status' => request('status'),
            'points' => request('points'),
            'user_id' => request('user_id'),
        ]);

        return redirect('/homepage');
    }
}
