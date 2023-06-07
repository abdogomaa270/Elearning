<?php

namespace App\project\ManageCourses\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\PaidCourses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayCourseController extends Controller
{
    public function checkExistance($userId,$courseId){
        // i want to check whether row exist or not

        $paidCourse = PaidCourses::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if ($paidCourse !== null) {
            return true;
        } else {
            return false;
        }


    }




    public function PayCourse($courseId)
    {
        try {
            DB::beginTransaction();

            // 1- get info
            $user = User::find(Auth::id());
            $balance = $user->balance;

            $course = Course::find($courseId);
            $course_price = $course->course_price;

            // 2- check existence
            if ($this->checkExistance($user->id, $course->id)) {
                return response()->json(['status' => 'course already paid'], 400);
            }

            // 3- check balance
            if ($balance < $course_price) {
                return response()->json(['status' => 'No enough balance'], 400);
            }

            // if the user has enough balance, add a row to the PaidCourses table
            $register = new PaidCourses();
            $register->user_id = Auth::id();
            $register->course_id = $courseId;
            $register->save();

            // after paying for the course, update the user's balance
            $new_balance = $balance - $course_price;
            $user->balance = $new_balance;
            $user->save();

            DB::commit();

            return response()->json(['status' => 'Paid Successfully ', 'current balance' => $new_balance], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            // handle the exception here
            return response()->json(['status' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
