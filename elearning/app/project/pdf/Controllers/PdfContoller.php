<?php

namespace App\project\pdf\Controllers;

use App\project\pdf\Requests\PdfRequest;
use App\project\pdf\Services\PdfService;

class PdfContoller
{
    private PdfService $PdfService ;
    public function __construct(PdfService $PdfService) {

        $this->PdfService = $PdfService;
    }
    public function showall(){
        return $this->PdfService->showall();
    }
    public function show($courseId){
        return $this->PdfService->show($courseId);
    }
    public function store(PdfRequest $request){
        return $this->PdfService->store($request);
    }
    public function destroy($id){
        return $this->PdfService->destroy($id);
    }

}
