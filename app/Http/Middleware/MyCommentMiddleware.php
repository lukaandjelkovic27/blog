<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyCommentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $comment = $request->route('comment');
        if (auth()->id() === $comment->user_id) {
            return $next($request);
        }
        abort(403);
    }
}
