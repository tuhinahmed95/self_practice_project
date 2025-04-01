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
        ]);

        $category = Category::find($id);
        if($request->category_icon == ''){
            Category::find($id)->update([
                'category_name' => $request->category_name,
            ]);
            return redirect()->route('category.list')->with('update', 'Category Updated!');
        }
        else{

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
    }

    public function category_soft_delete($id){
        $category = Category::find($id);
        $category->delete();
        return back()->with('soft_delete', 'Category Move To Trash!');
    }

    public function category_trash_list(){
        $categories = Category::onlyTrashed()->get();
        return view('admin.category.category_trash',compact('categories'));
    }

    public function category_restore($id){
        Category::onlyTrashed()->find($id)->restore();
        return back()->with('restore', 'Category Restored!');
    }

    public function category_permanent_delete($id){
        $category = Category::onlyTrashed()->find($id);

        if($category && $category->category_icon && file_exists(public_path('uploads/category/'.$category->category_icon))){
            unlink(public_path('uploads/category/'.$category->category_icon));
        }
        $category->forceDelete();
        return back()->with('permanent_delete', 'Category Trash has been deleted Permanentle');
    }

    public function category_check_delete(Request $request){
        foreach($request->category_id as $category){
            Category::find($category)->delete();
        }
        return back()->with('soft_delete', 'Category Move To Trash!');
    }

    public function category_bulk_action(Request $request){
        if(!$request->has('category_id')){
            return back()->with('error', 'No Category Selected');
        }

        if($request->action == '1'){
            foreach($request->category_id as $category){
                Category::onlyTrashed()->find($category)?->restore();
            }
            return back()->with('restore', 'Category Restored!');
        }
        elseif($request->action == '2'){
            foreach($request->category_id as $category){
               $cat =  Category::onlyTrashed()->find($category);
               if($cat && $cat->category_icon && file_exists(public_path('uploads/category/'.$cat->category_icon))){
                unlink(public_path('uploads/category/'.$cat->category_icon));
               }
               $cat->forceDelete();
            }
            return back()->with('check_delete', 'Category Checked All Delete!');
        }
    }
}
