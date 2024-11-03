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

        $status = $collection->getStatus();

        return view('collections.collection', [
            'collection' => $collection,
            'goals' => $goals,
            'deadline' => $collection->formattedDeadline(),
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

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        $collection->delete();
    }
}
