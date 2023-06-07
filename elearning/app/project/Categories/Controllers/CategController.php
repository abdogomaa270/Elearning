<?php

namespace App\project\Categories\Controllers;

use App\Models\Category;
use App\project\Categories\Requsts\CategoryRequest;
use App\project\Categories\Requsts\CatupdateRequest;
use App\project\Categories\Services\CategoriesService;
use http\Client\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CategController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private CategoriesService $categoriesService;
    public function __construct(CategoriesService $categoriesService) {

       $this->categoriesService = $categoriesService;
    }

    public function showall(){
        return $this->categoriesService->showall();
    }
    public function show($id){
       return $this->categoriesService->show($id);
        }
    public function store(CategoryRequest $request){
        return $this->categoriesService->store($request);
    }
    public function update(CatupdateRequest $request,$categ_id){
        return $this->categoriesService->update($request,$categ_id);
    }
    public function destroy($categ_id){
        return $this->categoriesService->destroy($categ_id);

    }
    public function get_Related_Subcateg($id){
        $category = Category::find($id);
        if($category===null){
            return response()->json(['status'=>'no related subcategories'],400);
        }
        return $category->subcategories;

    }

}
