<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{

    public function brand(){
        $pageTitle = 'Manage Brand';
        $brands = Brand::latest()->paginate(getPaginate());
        $emptyMessage  = 'No brand found';
        return view('admin.brand.index', compact('pageTitle', 'brands', 'emptyMessage'));
    }

    public function add(Request $request){

        $request->validate([
            'name'=> 'string|max:255|required|unique:brands,name',
        ]);

        $newCategory = new Brand();
        $newCategory->name = $request->name;
        $newCategory->slug = slug($request->name);
        $newCategory->save();

        $notify[] = ['success', 'New Brand Added Successfully'];
        return back()->withNotify($notify);
    }

    public function update(Request $request){

        $request->validate([
            'name'=> 'string|max:255|required|unique:brands,name,'.$request->id,
            'id'=> 'required|exists:brands,id',
            'status' => 'required|in:on'
        ]);

        $findBrand = Brand::find($request->id);
        $findBrand->name = $request->name;
        $findBrand->slug = slug($request->name);
        $findBrand->status = $request->status ? 1 : 0;
        $findBrand->save();

        $notify[] = ['success', 'Brand Updated Successfully'];
        return back()->withNotify($notify);
    }



}
