<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function store($goal_id)
    {
        request()->validate([
            'description' => ['required'],
        ]);

        Step::create([
            'description' => request('description'),
            'goal_id' => $goal_id,
        ]);
    }

    public function setStatus(Step $step)
    {
        $step->setStatus();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $step = Step::findOrFail($id);

        $step->delete();

        return redirect()->back();
    }
}
