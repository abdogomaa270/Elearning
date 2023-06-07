<?php

namespace App\project\Categories\Services;

use App\Models\Category;
use App\project\Categories\Requsts\CategoryRequest;
use App\project\Categories\Requsts\CatupdateRequest;
use http\Client\Request;
use http\Client\Response;
use Illuminate\Support\Facades\Storage;


class CategoriesService
{
    public function showall(){
        return Category::all();
    }
    public function store(CategoryRequest $request)
    {

        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        $category = new Category;
        $category->category_name = $request->get('category_name');
        $category->category_description = $request->get('category_description');
        $category->image = $imageUrl;
        $category->save();

        return response()->json(['status'=>'success'],200) ;
    }

    /*------------------------------------------------------------------------------*/
    public function show($id)
    {
        $category = Category::find($id);
        if($category===null){
            return response()->json(["status"=>'not exist'],200);
        }
        return response()->json(['status'=>'success','category'=>$category],200);

    }

    /*------------------------------------------------------------------------------*/
    public function update(CatupdateRequest $request, $id)
    {


        $category = Category::find($id);
        if($category===null) {
            return response()->json(['status'=>'not_found'],200);
        }
        if($request->has('category_name')) {
            $category->category_name = $request->get( 'category_name');
        }
        if($request->has('category_description')) {
            $category->category_description = $request->get('category_description');
        }
        if ($request->hasFile('image')) {
            Storage::delete($category->image);
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $category->image = $imageUrl;
        }

        $category->save();

        return response()->json(['status'=>'success','category'=>$category],200);
    }
    /*------------------------------------------------------------------------------*/
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        Storage::delete($category->image);
        $category->delete();

        return response()->json(['status'=>'success'],200);
    }

}
