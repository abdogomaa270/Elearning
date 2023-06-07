<?php

namespace App\project\Courses\Controllers;

use App\Models\Course;
use App\project\Courses\Requests\Course_Update_Request;
use App\project\Courses\Requests\CourseRequest;
use App\project\Courses\Services\CourseServices;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CourseController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private CourseServices $CourseServices;
    public function __construct(CourseServices $CourseServices) {

        $this->CourseServices = $CourseServices;
    }
    public function showall(){
        return $this->CourseServices->showall();
    }
    public function show($id){
        return $this->CourseServices->show($id);
    }

    public function store(CourseRequest $request){
        return $this->CourseServices->store($request);
    }
    public function update(Course_Update_Request $request , $course_id){
        return $this->CourseServices->update($request,$course_id);
    }
    public function destroy($course_id){
        return $this->CourseServices->destroy($course_id);

    }
    public function get_Related_lessons($id){
        $Course = Course::find($id);
        if($Course===null){
            return response()->json(['status'=>'not exist'],400);
        }
        return $Course->lessons;

    }

}
