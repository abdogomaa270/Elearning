<?php

namespace App\project\quizzes\Controller;

use App\project\quizzes\Requsts\QuizRequest;
use App\project\quizzes\Services\QuizService;

class QuizController
{
    private QuizService $QuizService ;
    public function __construct(QuizService $QuizService) {

        $this->QuizService = $QuizService;
    }
    public function showall(){
        return $this->QuizService->showall();
    }
    public function show($courseId){
        return $this->QuizService->show($courseId);
    }
    public function store(QuizRequest $request){
        return $this->QuizService->store($request);
    }

}
