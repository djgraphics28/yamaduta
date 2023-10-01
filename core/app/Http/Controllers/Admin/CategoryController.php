<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function category(){
        $pageTitle = 'Manage Category';
        $categories = Category::latest()->paginate(getPaginate());
        $emptyMessage  = 'No category found';
        return view('admin.category.index', compact('pageTitle', 'categories', 'emptyMessage'));
    }

    public function add(Request $request){

        $request->validate([
            'name'=> 'string|max:255|required|unique:categories,name',
        ]);

        $newCategory = new Category();
        $newCategory->name = $request->name;
        $newCategory->slug = slug($request->name);
        $newCategory->save();

        $notify[] = ['success', 'Category Added Successfully'];
        return back()->withNotify($notify);
    }

    public function update(Request $request){

        $request->validate([
            'name'      => 'string|max:255|required|unique:categories,name,'.$request->id,
            'id'        => 'required|exists:categories,id',
            'status'    => 'required|in:on'
        ]);

        $findCategory = Category::find($request->id);
        $findCategory->name = $request->name;
        $findCategory->slug = slug($request->name);
        $findCategory->status = $request->status ? 1 : 0;
        $findCategory->save();

        $notify[] = ['success', 'Category Updated Successfully'];
        return back()->withNotify($notify);
    }


}
