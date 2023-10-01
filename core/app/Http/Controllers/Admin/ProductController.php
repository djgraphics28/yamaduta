<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use App\Rules\FileTypeValidate;

class ProductController extends Controller
{
    public function index(Request $request){
        $products = Product::when($request->search, function($query) use ($request){
            $query->where('name', 'LIKE', '%' .$request->search. '%')->orWhere('sku', $request->search);
        })->latest()->with(['category','brand'])->paginate(getPaginate());

        $pageTitle = 'Manage Product';
        $categories = Category::latest()->get();
        $emptyMessage = 'Data Not Found';
        return view('admin.product.index', compact('pageTitle', 'products', 'categories', 'emptyMessage'));
    }

    public function addPage(){
        $pageTitle = 'Add Product';
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.add', compact('pageTitle', 'categories', 'brands'));
    }

    public function add(Request $request){

        $request->validate([
            'category'=> 'required|exists:categories,id',
            'brand'=> 'required|exists:brands,id',
            'name'=> 'required|max:255|unique:products,name',
            'price'=> 'required|numeric|gt:0',
            'discount'=> 'nullable|numeric|gte:0',
            'description'=> 'required',
            'image' => ['required','image',new FileTypeValidate(['jpg','jpeg','png'])],
            'status' => 'sometimes|in:on',
            'stock' => 'required|gte:0',
            'sku' => 'required|unique:products,sku',
        ]);

        $product = new Product();
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->slug = slug($request->name);
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->discount = $request->discount ?? 0;
        $product->status = $request->status ? 1 : 0;
        $product->featured = $request->featured ? 1 : 0;

        $product->image = uploadImage($request->image, imagePath()['product']['path'], imagePath()['product']['size']);

        $product->save();

        $notify[] = ['success', 'New product added successfully'];
        return back()->withNotify($notify);
    }

    public function updatePage($id){
        $product = Product::findOrFail($id);
        $pageTitle = 'Update Product';
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.update', compact('pageTitle', 'categories', 'product', 'brands'));
    }

    public function update(Request $request){

        $request->validate([
            'category'=> 'required|exists:categories,id',
            'brand'=> 'required|exists:brands,id',
            'id'=> 'required|exists:products,id',
            'name'=> 'required|max:255|unique:products,name,'.$request->id,
            'price'=> 'required|numeric|gt:0',
            'discount'=> 'nullable|numeric|gte:0',
            'description'=> 'required',
            'image' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])],
            'status' => 'sometimes|in:on',
            'stock' => 'required|gte:0',
            'sku' => 'required|unique:products,sku,'.$request->id,
        ]);

        $product = Product::find($request->id);
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->slug = slug($request->name);
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount ?? 0;

        $product->description = $request->description;
        $product->status = $request->status ? 1 : 0;
        $product->featured = $request->featured ? 1 : 0;

        if($request->hasFile('image')){
            $product->image = uploadImage($request->image, imagePath()['product']['path'], imagePath()['product']['size'], $product->image);
        }

        $product->save();

        $notify[] = ['success', 'Product Updated successfully'];
        return back()->withNotify($notify);
    }

    public function imagePage($id){
        $product = Product::findOrFail($id);
        $pageTitle = 'Product Images';
        return view('admin.product.images', compact('pageTitle', 'product'));
    }

    public function deleteImage(Request $request){

        $request->validate([
            'id'=> 'required|exists:product_images,id',
            'product_id'=> 'required|exists:products,id',
        ]);

        $find = ProductImage::where('id', $request->id)->where('product_id', $request->product_id)->firstOrFail();
        removeFile(imagePath()['product']['path'].'/'.$find->image);
        $find->delete();

        $notify[] = ['success', 'Product Image Deleted successfully'];
        return back()->withNotify($notify);
    }

    public function addImage(Request $request){

        $request->validate([
            'id'=> 'required|exists:products,id',
            'id'=> 'required|exists:products,id',
            'image'=> 'array',
            'image.*' => ['required','image',new FileTypeValidate(['jpg','jpeg','png'])],
        ]);

        if($request->hasFile('image')){
            foreach($request->image as $data){
                $new = new ProductImage();
                $new->product_id = $request->id;
                $new->image = uploadImage($data, imagePath()['product']['path'], imagePath()['product']['size']);
                $new->save();
            }
        }

        $notify[] = ['success', 'Product Image Added successfully'];
        return back()->withNotify($notify);
    }

    public function hotDeal($id)
    {
        $product = Product::findOrFail($id);
        if($product->hot_deal == 1){
            $product->hot_deal = 0;
            $msg = 'Product Removed from hot deals';
        } else {
            $product->hot_deal = 1;
            $msg = 'Product added as hot deals.';
        }
        $product->save();

        $notify[] = ['success', $msg];
        return back()->withNotify($notify);
    }



}
