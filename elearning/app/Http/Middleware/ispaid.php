<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ispaid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $course_id = $request->route('id'); ; // id of the course
        $user_id = Auth::id();
        $paid = DB::table('user_courses')->where('user_id', $user_id)->where('course_id', $course_id)->exists();
        if ($paid) {
            return $next($request); //move to the next step
        } else {
//            abort(403, 'Unauthorized access');
            return response()->json(['status'=>'UnPaidCourse'],400);
        }
    } //check authorization
}
