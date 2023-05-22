<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter
{
    /**
     * Apply the description filter
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Closure $next
     */
    public function handle(Builder $query, Closure $next)
    {
        $filter = request()->input('status');

        if ($filter && in_array($filter, ['pending', 'progress', 'completed'])) {
            $query = $query->whereStatus($filter);
        }

        return $next($query);
    }
}
