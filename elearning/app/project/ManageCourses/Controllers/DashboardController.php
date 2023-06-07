<?php

namespace App\project\ManageCourses\Controllers;

use App\Models\Course;
use App\Models\User;

class DashboardController
{
    public function Courses_state(){
        $courses=Course::with(['users'=>function($query){
            $query->select('id','name', 'email','phone');
        }])->select('id','course_name')->get();

        $courses = $courses->map(function($course) {
            $course->num_users = $course->users->count();
            unset($course->users->pivot);
            return $course;
        });
        return response()->json([$courses],200);

    }
    public function User_state(){
        $users=User::with(['courses'=>function($query){
            $query->select('id','course_name');
        }])->select('id','name','email','phone')->get();

        $users = $users->map(function($user) {
            $user->num_courses = $user->courses->count();
            return $user;
        });
        return response()->json([$users],200);
    }


    public function users(){
        $users=User::all();
        return response()->json([$users],200);
    }
}
