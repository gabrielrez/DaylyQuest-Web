<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        $collections = Collection::where('user_id', Auth::id())->get();

        $show_notice_modal = session('show_notice_modal', true);

        if ($show_notice_modal) {
            session(['show_notice_modal' => false]);
        }

        return view('homepage', [
            'collections' => $collections,
            'show_notice_modal' => $show_notice_modal,
        ]);
    }
}
