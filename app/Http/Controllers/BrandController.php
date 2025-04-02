<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brand_list(){
        $brands = Brand::all();
        return view('admin.brand.brand_list',compact('brands'));
    }

    public function brand_create(){
        return view('admin.brand.brand_create');
    }

    public function brand_store(Request $request){
        $request->validate([
            'brand_name' => 'required',
            'brand_logo' => 'required',
        ]);

        if($request->hasFile('brand_logo')){
            $brnad_logo = $request->file('brand_logo');
            $file_name = time().'.'. $brnad_logo->getClientOriginalExtension();
            $brnad_logo->move(public_path('uploads/brand'),$file_name);
        }
        Brand::create([
            'brand_name' => $request->brand_name,
            'brand_logo' => $file_name,
        ]);
        return redirect()->route('brand.list')->with('success', 'Brand has been Created!');

    }

    public function brand_edit($id){
        $brand = Brand::find($id);
        return view('admin.brand.brand_edit',compact('brand'));
    }

    public function brand_update(Request $request,$id){
        $request->validate([
            'brand_name' => 'required',
        ]);

        $brand = Brand::find($id);
        $file_name = $brand->brand_logo;
        if($request->hasFile('brand_logo')){
            if($brand && $brand->brand_logo && file_exists(public_path('uploads/brand/'.$brand->brand_logo))){
                unlink(public_path('uploads/brand/'.$brand->brand_logo));
            }

            $brnad_logo = $request->file('brand_logo');
            $file_name = time().'.'. $brnad_logo->getClientOriginalExtension();
            $brnad_logo->move(public_path('uploads/brand'),$file_name);
        }

        $brand->update([
            'brand_name' => $request->brand_name,
            'brand_logo' => $file_name,
        ]);
        return redirect()->route('brand.list')->with('update', 'Brand Updated!');
    }

    public function brand_soft_delete($id){
        Brand::find($id)->delete();
        return back();
    }

    public function brand_trash_list(){
        $brands = Brand::onlyTrashed()->get();
        return view('admin.brand.trash_list',compact('brands'));
    }

    public function brand_restore($id){
        Brand::onlyTrashed()->find($id)->restore();
        return back();
    }

    public function brand_permanent_delete($id){
       $brand =  Brand::onlyTrashed()->find($id);

       if($brand && $brand->brand_logo && file_exists(public_path('uploads/brand/'.$brand->brand_logo))){
        unlink(public_path('uploads/brand/'.$brand->brand_logo));
       }
       $brand->forceDelete();
       return back();
    }

    public function brand_check_delete(Request $request){
        foreach($request->brand_id as $brand){
            Brand::find($brand)->delete();
        }
        return back()->with('check_delete', 'All Brand Deleted!');
    }

    public function brand_bulk_action(Request $request){
        if(!$request->has('brand_id')){
            return back()->with('error', 'No Brand has been Selected!');
        }

        if($request->action == '1'){
            foreach($request->brand_id as $brand){
                Brand::onlyTrashed()->find($brand)->restore();
            }
            return back()->with('check_restore', 'All Brand has been Restroed!!');
        }
        elseif($request->action == '2'){
            foreach($request->brand_id as $brand){
              $brand =  Brand::onlyTrashed()->find($brand);
              if($brand && $brand->brand_logo && file_exists(public_path('uploads/brand/'.$brand->brand_logo))){
                unlink(public_path('uploads/brand/'.$brand->brand_logo));
               }
              $brand->forceDelete();
            }
            return back()->with('check_delete', 'All Brand has been Deleted!!');

        }
    }
}
