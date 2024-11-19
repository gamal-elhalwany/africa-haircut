<?php

namespace App\Http\Middleware;

use App\Models\Appointment;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckAppointmentsExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::now();
        $appointments = Appointment::where('appointment_date', '<=', $now)->update(['status' => 'completed']);
        return $next($request);
    }
}
