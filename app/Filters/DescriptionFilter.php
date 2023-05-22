<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class DescriptionFilter
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
            $query->where('description', 'like', '%'.$filter.'%');
        }

        return $next($query);
    }
}
