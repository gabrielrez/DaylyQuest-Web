<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomepageController extends Controller
{
    private $collection_model;

    public function __construct(Collection $collection_model)
    {
        $this->collection_model = $collection_model;
    }

    public function index(string $filter = 'all'): View
    {
        if (!in_array($filter, ['all', 'completed', 'in-progress', 'expired'])) {
            abort('404');
        }

        $collections = $this->collection_model->filterCollections($filter);

        $show_notice_modal = session('show_notice_modal', true);

        if ($show_notice_modal) {
            session(['show_notice_modal' => false]);
        }

        return view('homepage', [
            'collections' => $collections,
            'show_notice_modal' => $show_notice_modal,
            'filter' => $filter,
        ]);
    }
}
