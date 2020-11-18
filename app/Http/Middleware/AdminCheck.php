<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class AdminCheck.
 */
class AdminCheck
{
    /**
     * @param $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->id === 1) {
            return $next($request);
        }

        return redirect()->route('dashboard')->withFlashDanger(__('У вас нет доступа'));
    }
}
