<?php

namespace BrooksYang\Entrance\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class EntrancePermission
{
    protected $auth;

    /**
     * EntrancePermission constructor.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the request method and uri
        $method = $request->method();
        $uri = $request->route()->uri();

        // Check if the user has permission by the request method and uri.
        if ($this->auth->guest() || !$request->user()->hasPermission($method, $uri)) {
            if ($request->ajax()) {
                return response()->json(['code' => 403, 'error' => 'Permission Denied']);
            }

            abort(403, 'Permission Denied');
        }

        return $next($request);
    }
}
