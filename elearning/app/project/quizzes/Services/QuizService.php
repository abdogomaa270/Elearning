<?php

namespace App\project\quizzes\Services;

use App\Models\quiz;
use App\project\quizzes\Requsts\QuizRequest;


class QuizService
{
    public function showall(){
        $quizzes = quiz::all();
        if($quizzes===null) {
            return response()->json(['status'=>'no data'],400);
        }
        return response()->json(['data'=>$quizzes],400);
    }

    public function store(QuizRequest $request)
    {
        $quiz=new quiz();
        $quiz->course_id = $request->get('course_id') ;
        $quiz->question  = $request->get('question');
        $quiz->ques_options   = $request->get('ques_options');
        $quiz->answer   = $request->get('answer');
        $quiz->save();
        return response()->json(['status'=>'success'],200) ;
    }

    public function show($courseId)
    { //return the array
        $quiz = quiz::where('course_id',$courseId)->get();
        if($quiz===null){
            return response()->json(["status"=>'not exist'],200);
        }
        foreach ($quiz as $q) {
            $q->ques_options = explode(',', $q->ques_options);
        }

        return response()->json(['quiz'=>$quiz],200);
    }

}
