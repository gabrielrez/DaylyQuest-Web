<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function store(int $goal_id): void
    {
        request()->validate([
            'description' => ['required'],
        ]);

        Step::create([
            'description' => request('description'),
            'goal_id' => $goal_id,
        ]);
    }

    public function setStatus(Step $step): RedirectResponse
    {
        $step->setStatus();

        return redirect()->back();
    }

    public function destroy(int $id): RedirectResponse
    {
        $step = Step::findOrFail($id);

        $step->delete();

        return redirect()->back();
    }
}
