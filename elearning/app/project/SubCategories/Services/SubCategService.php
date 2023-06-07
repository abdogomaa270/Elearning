<?php

namespace App\project\SubCategories\Services;


use App\Models\SubCategory;
use App\project\SubCategories\Requests\Sub_Categ_Update_Req;
use App\project\SubCategories\Requests\SubCategRequest;
use http\Client\Request;
use http\Client\Response;
use Illuminate\Support\Facades\Storage;


class SubCategService
{
    public function showall(){
        $data = SubCategory::all();
        if($data===null) {
            return response()->json(['status'=>'no data'],400);
        }
        return $data;
    }

    public function store(SubCategRequest $request)
    {

        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        $subcategory = new SubCategory;
        $subcategory->category_id=$request->get('category_id');
        $subcategory->sub_category_name = $request->get('sub_category_name');
        $subcategory->sub_category_description =$request->get('sub_category_description');
        $subcategory->image = $imageUrl;
        $subcategory->save();

        return response()->json(['status'=>'success'],200) ;
    }

    /*------------------------------------------------------------------------------*/
    public function show($id)
    {
        $subcategory = Subcategory::find($id);
        if($subcategory===null){
            return response()->json(["status"=>'not exist'],200);
        }
        return response()->json(['status'=>'success','subcategory'=>$subcategory],200);
    }

    /*------------------------------------------------------------------------------*/
    public function update(Sub_Categ_Update_Req $request, $id)
    {


        $subcategory = SubCategory::find($id);
        if ($subcategory===null) {
            return response()->json(['status'=>'not_found'],400);
        }
        if ($request->has('category_id')) {
            $subcategory->category_id = $request->get( 'category_id');
        }

        if ($request->has('sub_category_name')) {
            $subcategory->sub_category_name = $request->get( 'sub_category_name');
        }
        if ($request->has('sub_category_description')) {
            $subcategory->sub_category_description = $request->get('sub_category_description');
        }
        if ($request->hasFile('image')) {
            Storage::delete($subcategory->image);
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $subcategory->image = $imageUrl;
        }

        $subcategory->save();

        return response()->json(['status'=>'success','category'=>$subcategory],200);
    }
    /*------------------------------------------------------------------------------*/
    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);
        if($subcategory===null){
            return response()->json(['status'=>'not_found'],400);
        }
        Storage::delete($subcategory->image);
        $subcategory->delete();

        return response()->json(['status'=>'success'],200);
    }

}
