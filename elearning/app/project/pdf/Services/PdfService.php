<?php

namespace App\project\pdf\Services;

use App\Models\pdf;
use App\project\pdf\Requests\PdfRequest;
use Illuminate\Support\Facades\Storage;

class PdfService
{
    public function showall(){
        return pdf::all();
    }
    /*------------------------------------------------------------------------------------------------*/
    public function store(PdfRequest $request){
        $pdf =new pdf();
        $pdfPath = $request->file('pdf')->store('public/pdfs');
        $pdfUrl = Storage::url($pdfPath);
        $pdf->pdf = $pdfUrl;
        $pdf->course_id=$request->course_id;
        $pdf->save();
        return response()->json(['status'=>'stored successfully'],200);
    }

    /*------------------------------------------------------------------------------------------------*/

    public function show($courseId)
    {
        $pdf = pdf::where('course_id',$courseId)->get();
        if($pdf===null){
            return response()->json(["status"=>'not exist'],200);
        }
        return response()->json(['status'=>'success','pdf'=>$pdf],200);

    }
    /*------------------------------------------------------------------------------------------------*/

    public function destroy($id)
    {
        $pdf = pdf::find($id);
        if($pdf !== null) {
            Storage::delete($pdf->pdf);
            $pdf->delete();

            return response()->json(['status' => 'success'], 200);
        }

        return response()->json(['status' => 'not exist'], 200);
    }

}
