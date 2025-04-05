<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_list(){
        $products = Product::all();
        return view('admin.product.product_list',compact('products'));
    }

    public function product_create(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.product_create',compact('categories','subcategories','brands'));
    }

    public function getsubCategory(Request $request){
        $str = ' <option value="">Select Category</option>';
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        foreach($subcategories as $subcategory){
            $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str;
    }

    public function porduct_store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'nullable',
            'price' => 'required',
            'discount' => 'nullable',
            'short_des' => 'nullable',
            'long_des' => 'nullable',
            'tags' => 'nullable',
            'slug' => 'nullable',
            'status' => 'nullable',
            'preview' => 'required',
            'gallery' => 'nullable',
        ]);

        if($request->hasFile('preview')){
            $preview = $request->file('preview');
            $file_name = time().'.'.$preview->getClientOriginalExtension();
            $preview->move(public_path('uploads/product/preview'),$file_name);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'after_discount' => $request->price - $request->price*$request->discount/100,
            'tags' => implode(',', $request->tags),
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'addi_info' => $request->addi_info,
            'preview' => $file_name,
            'created_at' => Carbon::now(),
        ]);

        $product_id = $product->id;
        $galleries = $request->gallery;
        foreach($galleries as $gallery){
            $file_name = uniqid().'.'.$gallery->getClientOriginalExtension();
            $gallery->move(public_path('uploads/product/gallery'),$file_name);

            ProductGallery::create([
                'product_id' => $product_id,
                'gallery' => $file_name,
                'created_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('product.list')->with('success', 'Product has been Created Successfully!');
    }

    public function getStatus(Request $request){
        Product::find($request->product_id)->update([
            'status' => $request->status,
        ]);
    }
}
