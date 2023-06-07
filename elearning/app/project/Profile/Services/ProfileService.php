<?php

namespace App\project\Profile\Services;

use App\Models\certificate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//what is Auth /optimization for code

class ProfileService
{
    public function checkExistance2($userId,$courseId){
        // i want to check whether row exist or not

        $certificate = certificate::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if ($certificate !== null) {
            return true;
        } else {
            return false;
        }


    }

    public function setCerificate($courseId){

        if($this->checkExistance2(Auth::id(),$courseId))
        {
            return response()->json(['status'=>'certificate already taken'],400);
        }
        $certificate=new certificate();
        $certificate->user_id = Auth::id();
        $certificate->course_id = $courseId ;
        $certificate->save();
        return response()->json(['status'=>'stored successfully'],200);

    }

    public function getMyCertificates(){
        $data = Auth::user()->certificates; //return courses that user has taken
        return response()->json(['user'=> $data],200);
    }
    // my courses ?

    public function getMyCourses(){
        $user = User::find(Auth::id());
        $courses = $user->courses;
        return response()->json(['courses'=> $courses],200);
    }

    public function updateBalance($requestValue,$userId)
    {
        try {
            DB::beginTransaction();

            $user = User::find($userId);
            $user_balance = $user->balance;

            // calculate new value
            $newBalance = $user_balance + $requestValue;

            // update balance
            $user->balance = $newBalance;
            $user->save();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            // handle the exception here
            return false;
        }
    }
    public function myData(){
        $user = User::find(Auth::id());
        return response()->json(['user'=>$user],200);
    }

// create my registered courses 3ady
}
