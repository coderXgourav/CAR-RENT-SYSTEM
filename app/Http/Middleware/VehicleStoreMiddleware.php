<?php

namespace App\Http\Middleware;

use App\Constants\Status;
use Closure;
use Illuminate\Http\Request;

class VehicleStoreMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        $user = auth()->user();
        if (!$user->store) {
            $notify[] = ['error', 'Before proceeding, it is necessary to create the store'];
            return back()->withNotify($notify);
        }
        if ($user->store != Status::STORE_APPROVED) {
            $notify[] = ['error', 'You can\'t add vehicles until the store approved'];
            return back()->withNotify($notify);
        }
        return $next($request);
    }
}
