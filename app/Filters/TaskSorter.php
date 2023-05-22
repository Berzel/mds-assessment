<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class TaskSorter
{
    /**
     * Apply the description filter
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Closure $next
     */
    public function handle(Builder $query, Closure $next)
    {
        $sort = request()->input('sort');

        if ($sort) {
            list($column, $order) = explode(':', $sort);
            $query = $query->orderBy($column, $order);
        } else {
            $query = $query->latest();
        }

        return $next($query);
    }
}
