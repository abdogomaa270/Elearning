<?php

namespace App\project\Lessons\Services;

use App\Models\Course;
use App\Models\Lesson;
use App\project\Lessons\Requests\Lesson_Update_Request;
use App\project\Lessons\Requests\LessonRequest;
use Illuminate\Support\Facades\Storage;

class LessonService
{
    public function showall(){
        $data = Lesson::all();
        if($data===null) {
            return response()->json(['status'=>'no data'],400);
        }
        return $data;
    }
    public function store(LessonRequest $request)
    {

        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        $Lesson = new Lesson;
        $Lesson->name = $request->get('name');
        $Lesson->description	 = $request->get('description');
        $Lesson->course_id = $request->get('course_id');
        $Lesson->content	 = $request->get('content');
        $Lesson->image = $imageUrl;
        $Lesson->save();

        return response()->json(['status'=>'success'],200) ;
    }
    public function show($id)
    {
        $Lesson = Lesson::find($id);
        if($Lesson===null){
            return response()->json(["status"=>'not exist'],200);
        }
        return response()->json(['status'=>'success','Course'=>$Lesson],200);
    }
    /*------------------------------------------------------------------------------------------------------*/
    public function update(Lesson_Update_Request $request, $id)
    {
        $Lesson = Course::find($id);
        //check existance of instructor
        if($Lesson===null){
            return response()->json(['status'=>'Lesson not founc'],400);
        }

        if ($request->has('name')) {
            $Lesson->name = $request->get( 'name');
        }
        if ($request->has('description')) {
            $Lesson->description = $request->get( 'description');
        }
        if ($request->has('course_id')) {
            $Lesson->course_id = $request->get( 'course_id');
        }
        if ($request->has('content')) {
            $Lesson->content = $request->get( 'content');
        }

        if ($request->hasFile('image')) {
            Storage::delete($Lesson->image);
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $Lesson->image = $imageUrl;
        }

        $Lesson->save();

        return response()->json(['status'=>'success','lesson'=>$Lesson],200);
    }
    public function destroy($id)
    {
        $Lesson = Lesson::find($id);
        if($Lesson===null){
            return response()->json(['status'=>'not_found'],400);
        }
        Storage::delete($Lesson->image);
        $Lesson->delete();

        return response()->json(['status'=>'success'],200);
    }

}
