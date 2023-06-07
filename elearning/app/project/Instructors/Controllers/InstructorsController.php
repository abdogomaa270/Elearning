<?php

namespace App\project\Instructors\Controllers;

use App\Models\instructor;
use App\project\Instructors\Requests\Instructor_update_request;
use App\project\Instructors\Requests\InstructorRequest;
use App\project\Instructors\Services\InstructorService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class InstructorsController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private InstructorService $InstructorService;
    public function __construct(InstructorService $InstructorService) {

        $this->InstructorService = $InstructorService;
    }
    public function showall(){
        return $this->InstructorService->showall();
    }

    public function show($id){
        return $this->InstructorService->show($id);
    }

    public function store(InstructorRequest $request){
        return $this->InstructorService->store($request);
    }
    public function update(Instructor_update_request $request,$in_categ_id){
        return $this->InstructorService->update($request,$in_categ_id);
    }
    public function destroy($in_categ_id){
        return $this->InstructorService->destroy($in_categ_id);

    }
    public function get_Related_courses($id){
        $instructor = instructor::find($id);
        if($instructor===null){
            return response()->json(['status'=>'not exist'],400);
        }
        return $instructor->courses;

    }


}
