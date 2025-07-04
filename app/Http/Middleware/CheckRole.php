<?php
// app/Http/Middleware/CheckRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  The role to check
     * @return mixed
     */
    // app/Http/Middleware/CheckRole.php
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek role pengguna
        \Log::info('User Role: ' . $request->user()->role);

        if ($request->user()->role !== $role) {
            return redirect('/');
        }

        return $next($request);
    }

}
