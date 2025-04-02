<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function subcategory_list(){
        $subcategories = Subcategory::with('category')->get();
        return view('admin.subcategory.subcategory_list',compact('subcategories'));
    }

    public function subcategory_create(){
        $categories = Category::all();
        return view('admin.subcategory.subcategory_crete',compact('categories'));
    }

    public function subcategory_store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
            'subcategory_icon' => 'required',
        ]);

        if($request->hasFile('subcategory_icon')){
            $subcat_icon = $request->file('subcategory_icon');
            $file_name = time().'.'.$subcat_icon->getClientOriginalExtension();
            $subcat_icon->move(public_path('uploads/subcategory'),$file_name);
        }

        Subcategory::create([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_icon' => $file_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('subcategory.list')->with('success', 'SubCategory has been Created!');
    }

    public function subcategory_edit($id){
        $subcategory = Subcategory::find($id);
        $categories = Category::all();
        return view('admin.subcategory.subcategory_edit',compact('subcategory','categories'));
    }

    public function subcategory_update(Request $request, $id){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
            'subcategory_icon' => 'nullable',
        ]);

        $subcat = Subcategory::find($id);
        $file_name = $subcat->subcategory_icon;
        if($request->hasFile('subcategory_icon')){
            if($subcat && $subcat->subcategory_icon && file_exists(public_path('uploads/subcategory/'.$subcat->subcategory_icon))){
                unlink(public_path('uploads/subcategory/'.$subcat->subcategory_icon));
            }

            $subcat_icon = $request->file('subcategory_icon');
            $file_name = time().'.'.$subcat_icon->getClientOriginalExtension();
            $subcat_icon->move(public_path('uploads/subcategory'),$file_name);
        }

        $subcat->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_icon' => $file_name,
        ]);
        return redirect()->route('subcategory.list')->with('update', 'SubCategory Updated!');
    }

    public function subcategory_soft_delete($id){
        Subcategory::find($id)->delete();
        return back();
    }

    public function subcategory_trash_list(){
        $subcategories = Subcategory::onlyTrashed()->with('category')->get();
        return view('admin.subcategory.subcategory_trash',compact('subcategories'));
    }

    public function subcategory_restore($id){
        Subcategory::onlyTrashed()->find($id)->restore();
        return back();
    }

    public function subcategory_permanent_delete($id){
        Subcategory::onlyTrashed()->find($id)->forceDelete();
        return back();
    }

    public function subcategory_check_delete(Request $request){
       foreach( $request-> subcategory_id as $subcategory){
            Subcategory::find($subcategory)->delete();
       }
       return back()->with('check_delete', 'Subcategory Cheked Deleted!');
    }

    public function subcategory_bulk_action(Request $request){
        if(!$request->has('subcategory_id')){
            return back()->with('error', 'No SubCategory has been Selected!');
        }
        if($request->action == '1'){
            foreach($request->subcategory_id as $subcategory){
                Subcategory::onlyTrashed()->find($subcategory)->restore();
            }
            return back()->with('check_restore', 'Subcategory Cheked Restored!!');
        }
        elseif($request->action == '2'){
            foreach($request->subcategory_id as $subcategory){
                $sub_cat = Subcategory::onlyTrashed()->find($subcategory);
                if($sub_cat && $sub_cat->subcategory_icon && file_exists(public_path('uploads/subcategory/'.$sub_cat->subcategory_icon))){
                    unlink(public_path('uploads/subcategory/'.$sub_cat->subcategory_icon));
                }
                $sub_cat->forceDelete();
            }
            return back()->with('check_delete', 'Subcategory check has been Deleted!');
        }
    }
}
