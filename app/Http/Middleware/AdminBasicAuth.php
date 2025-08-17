<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminBasicAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $username = env('ADMIN_USERNAME', 'admin');
        $password = env('ADMIN_PASSWORD');

        if (empty($password)) {
            abort(500, 'Admin password not configured. Set ADMIN_USERNAME and ADMIN_PASSWORD in your .env');
        }

        $providedUser = $request->getUser();
        $providedPass = $request->getPassword();

        if ($providedUser !== $username || $providedPass !== $password) {
            return response('Unauthorized.', 401, [
                'WWW-Authenticate' => 'Basic realm="Admin Area"',
            ]);
        }

        return $next($request);
    }
} 