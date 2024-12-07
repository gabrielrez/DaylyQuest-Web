<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Goal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CollectionController extends Controller
{
    protected $collection_model;

    public function __construct(Collection $collection_model)
    {
        $this->collection_model = $collection_model;
    }

    public function show(int $id): View|Response
    {
        $collection = Collection::findOrFail($id);

        if ($collection->user_id !== Auth::id()) {
            abort(404);
        }

        $goals = Goal::where('collection_id', $id)->get();

        return view('collections.collection', [
            'collection' => $collection,
            'goals' => $goals,
            'deadline' => $collection->formattedDeadline(),
            'status' => $collection->getStatus(),
            'completion_percentage' => $this->collection_model->completetionPercentage($goals),
        ]);
    }

    public function create(): View
    {
        return view('collections.collection-create');
    }

    public function store(): RedirectResponse
    {
        // if (Auth::user()->collections->count() >= 4) {
        //     return redirect('/homepage')->with('show_limit_modal', true);
        // }

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

    public function update(int $id): RedirectResponse
    {
        $collection = Collection::findOrFail($id);

        request()->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);

        $collection->update([
            'title' => request('title'),
            'description' => request('description'),
        ]);

        return redirect('/collection/' . $collection->id);
    }

    public function destroy(int $id): void
    {
        $collection = Collection::findOrFail($id);
        $collection->delete();
    }
}
