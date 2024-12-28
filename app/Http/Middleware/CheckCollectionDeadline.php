<?php

namespace App\Http\Middleware;

use App\Models\Collection;
use App\Models\Goal;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckCollectionDeadline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $collection_id = request()->route('collection') ?? $this->collectionId();

        $collection = Collection::findOrFail($collection_id);

        if ($collection->hasExpired()) {
            return redirect()->back();
        }

        return $next($request);
    }

    private function collectionId()
    {
        $goal = Goal::findOrFail(request()->route('goal'));

        return $goal->collection_id;
    }
}
