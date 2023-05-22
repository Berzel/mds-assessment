<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class TitleFilter
{
    /**
     * Apply the description filter
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Closure $next
     */
    public function handle(Builder $query, Closure $next)
    {
        if ($filter = request()->input('q')) {
            $query->where('title', 'like', '%'.$filter.'%');
        }

        return $next($query);
    }
}
