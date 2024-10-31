<?php

namespace App\Http\Middleware;

use App\Models\Collection;
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
        $collection_id = $request->route('collection_id') ?? $request->route('goal')->collection_id;
        $collection = Collection::find($collection_id);

        if (Carbon::now()->greaterThan($collection->deadline) && $collection->cyclic != 1) {
            return redirect()->back()->with('expired', 'The deadline for this collection has expired');
        }

        return $next($request);
    }
}
