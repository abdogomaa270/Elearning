<?php

namespace App\project\Lessons\Controllers;

use App\project\Lessons\Requests\Lesson_Update_Request;
use App\project\Lessons\Requests\LessonRequest;
use App\project\Lessons\Services\LessonService;
use App\project\SubCategories\Requests\Sub_Categ_Update_Req;
use App\project\SubCategories\Requests\SubCategRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class LessonController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private LessonService $LessonService;
    public function __construct(LessonService $LessonService) {

        $this->LessonService = $LessonService;
    }

    public function showall(){
        return $this->LessonService->showall();
    }
    public function show($id){
        return $this->LessonService->show($id);
    }
    public function store(LessonRequest $request){
        return $this->LessonService->store($request);
    }
    public function update(Lesson_Update_Request $request,$Sub_categ_id){
        return $this->LessonService->update($request,$Sub_categ_id);
    }
    public function destroy($SubCateg_id){
        return $this->LessonService->destroy($SubCateg_id);

    }



}
