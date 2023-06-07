<?php

namespace App\project\Courses\Services;

use App\Models\Course;
use App\project\Courses\Requests\Course_Update_Request;
use App\project\Courses\Requests\CourseRequest;
use App\project\Instructors\Requests\Instructor_update_request;
use Illuminate\Support\Facades\Storage;

class CourseServices
{
    public function showall(){
        $data = Course::all();
        if($data===null) {
            return response()->json(['status'=>'no data'],400);
        }
        return $data;
    }

    public function store(CourseRequest $request)
    {

        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        $certificate_path = $request->file('certificate')->store('public/certificates');
        $certificate_Url = Storage::url($certificate_path);

        $Course = new Course;
        /*                    save attributes                                                    */
        $Course->sub_category_id = $request->get('sub_category_id');
        $Course->instructor_id	 = $request->get('instructor_id');
        $Course->course_name = $request->get('course_name');
        $Course->course_description	 = $request->get('course_description');
        $Course->course_price = $request->get('course_price');
        /*                    save images pathes                                 */
        $Course->image = $imageUrl;
        $Course->certificate = $certificate_Url;

        $Course->save();

        return response()->json(['status'=>'success'],200) ;
    }
    public function show($id)
    {
        $Course = Course::find($id);
        if($Course===null){
            return response()->json(["status"=>'not exist'],200);
        }
        $instructor=$Course->instructor;
        return response()->json(['Course'=>$Course],200);
    }
    /*------------------------------------------------------------------------------------------------------*/
    public function update(Course_Update_Request $request, $id)
    {
        $Course = Course::find($id);
        //check existance of instructor
        if($Course===null){
            return response()->json(['status'=>'Course not founc'],400);
        }

        if ($request->has('sub_category_id')) {
            $Course->sub_category_id = $request->get( 'sub_category_id');
        }
        if ($request->has('instructor_id')) {
            $Course->instructor_id = $request->get( 'instructor_id');
        }
        if ($request->has('course_name')) {
            $Course->course_name = $request->get( 'course_name');
        }
        if ($request->has('course_description')) {
            $Course->course_description = $request->get( 'course_description');
        }

        if ($request->has('course_price')) {
            $Course->course_price = $request->get( 'course_price');
        }

        if ($request->hasFile('image')) {
            Storage::delete($Course->image);
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $Course->image = $imageUrl;
        }

        $Course->save();

        return response()->json(['status'=>'success','Course'=>$Course],200);
    }

    public function destroy($id)
    {
        $Course = Course::find($id);
        if($Course===null){
            return response()->json(['status'=>'not_found'],400);
        }
        Storage::delete($Course->image);
        $Course->delete();

        return response()->json(['status'=>'success'],200);
    }


}
