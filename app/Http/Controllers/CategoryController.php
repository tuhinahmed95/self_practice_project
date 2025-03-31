<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_list(){
        $categories = Category::all();
        return view('admin.category.category_list',compact('categories'));
    }

    public function category_create(){
        return view('admin.category.category_create');
    }

    public function category_store(Request $request){
        $request->validate([
            'category_name' => 'required',
            'category_icon' => 'required'
        ]);

        if($request->hasFile('category_icon')){
            $category_icon = $request->file('category_icon');
            $file_name = time().'.'.$category_icon->getClientOriginalExtension();
            $category_icon->move(public_path('uploads/category'),$file_name);
        }

        Category::create([
            'category_name' => $request->category_name,
            'category_icon' => $file_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('category.list')->with('success', 'Category Inserted Sucessfully');
    }

    public function category_edit($id){
        $category = Category::find($id);
        return view('admin.category.category_edit',compact('category'));
    }

    public function category_update(Request $request, $id){
        $request->validate([
            'category_name' => 'required',
            'category_icon' => 'required',
        ]);

        $category = Category::find($id);
        $file_name = $category->category_icon;

        if($category && $category->category_icon && file_exists(public_path('uploads/category/'.$category->category_icon))){
            unlink(public_path('uploads/category/'.$category->category_icon));
        }

        if($request->hasFile('category_icon')){
            $category_icon = $request->file('category_icon');
            $file_name = time().'.'.$category_icon->getClientOriginalExtension();
            $category_icon->move(public_path('uploads/category'),$file_name);
        }

        $category->update([
            'category_name' => $request->category_name,
            'category_icon' => $file_name,
        ]);

        return redirect()->route('category.list')->with('update', 'Category Updated!');
    }

    public function category_delete($id){
        $category = Category::find($id);

        if($category && $category->category_icon && file_exists(public_path('uploads/category/'.$category->category_icon))){
            unlink(public_path('uploads/category/'.$category->category_icon));
        }
        $category->delete();
        return back()->with('delete', 'Category has been Deleted!');
    }
}
