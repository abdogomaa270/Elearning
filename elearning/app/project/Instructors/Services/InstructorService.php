<?php

namespace App\project\Instructors\Services;

use App\Models\instructor;
use App\project\Instructors\Requests\Instructor_update_request;
use App\project\Instructors\Requests\InstructorRequest;
use Illuminate\Support\Facades\Storage;

class InstructorService
{
    public function showall(){
        $data = instructor::all();
        if($data===null) {
            return response()->json(['status'=>'no data'],400);
        }
        return $data;
    }

    public function store(InstructorRequest $request)
    {

        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        $instructor = new instructor;
        $instructor->instructor_name = $request->get('instructor_name');
        $instructor->instructor_description	 = $request->get('instructor_description');
        $instructor->image = $imageUrl;
        $instructor->save();

        return response()->json(['status'=>'success'],200) ;
    }

    /*------------------------------------------------------------------------------*/
    public function show($id)
    {
        $instructor = instructor::find($id);
        if($instructor===null){
            return response()->json(["status"=>'not exist'],200);
        }
        return response()->json(['status'=>'success','instructor'=>$instructor],200);
    }

    /*------------------------------------------------------------------------------*/
    public function update(Instructor_update_request $request, $id)
    {


        $instructor = instructor::find($id);
        //check existance of instructor
        if($instructor===null){
            return response()->json(['status'=>'user not founc'],400);
        }

        if ($request->has('instructor_name')) {
            $instructor->instructor_name = $request->get( 'instructor_name');
        }

        if ($request->has('instructor_description')) {
            $instructor->instructor_description = $request->get( 'instructor_description');
        }

        if ($request->hasFile('image')) {
            Storage::delete($instructor->image);
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $instructor->image = $imageUrl;
        }

        $instructor->save();

        return response()->json(['status'=>'success','category'=>$instructor],200);
    }
    /*------------------------------------------------------------------------------*/
    public function destroy($id)
    {
        $instructor = instructor::find($id);
        if($instructor===null){
            return response()->json(['status'=>'not_found'],400);
        }
        Storage::delete($instructor->image);
        $instructor->delete();

        return response()->json(['status'=>'success'],200);
    }

}
