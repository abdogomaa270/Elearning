<?php

namespace App\project\SubCategories\Controllers;

use App\Models\SubCategory;
use App\project\SubCategories\Requests\Sub_Categ_Update_Req;
use App\project\SubCategories\Requests\SubCategRequest;
use App\project\SubCategories\Services\SubCategService;
use http\Client\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class SubCategController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private SubCategService $SubCategService;
    public function __construct(SubCategService $SubCategService) {

        $this->SubCategService = $SubCategService;
    }

    public function showall(){
        return $this->SubCategService->showall();
    }
    public function show($id){
        return $this->SubCategService->show($id);
    }
    public function store(SubCategRequest $request){
        return $this->SubCategService->store($request);
    }
    public function update(Sub_Categ_Update_Req $request,$Sub_categ_id){
        return $this->SubCategService->update($request,$Sub_categ_id);
    }
    public function destroy($SubCateg_id){
        return $this->SubCategService->destroy($SubCateg_id);

    }
    public function get_Related_courses($id){
        $SubCateg = SubCategory::find($id);
        if($SubCateg===null){
            return response()->json(['status'=>'not exist'],400);
        }
        return $SubCateg->courses;

    }

}
