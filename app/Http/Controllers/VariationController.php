<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function color_list(){
        $colors = Color::all();
        return view('admin.variation.color_list',compact('colors'));
    }

    public function color_create(){
        return view('admin.variation.color_create');
    }

    public function color_store(Request $request){
        $request->validate([
            'color_name' => 'required',
            'color_code' => 'required',
        ]);

        Color::create([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);
        return redirect()->route('color.list')->with('success', 'Color Successfully Added');
    }

    public function color_delete($id){
        Color::find($id)->delete();
        return redirect()->route('color.list')->with('delete','Color has been Deleted');
    }

    public function size_list(){
        $sizes = Size::all();
        return view('admin.variation.size_list',compact('sizes'));
    }

    public function size_create(){
        $categories = Category::all();
        return view('admin.variation.size_create',compact('categories'));
    }

    public function size_store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'size_name' => 'required',
        ]);

        Size::create([
            'category_id' => $request->category_id,
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('size.list')->with('success', 'Size Added!');

    }

    public function size_delete($id){
        Size::find($id)->delete();
        return back()->with('delete','Seze has been Deleted');
    }
}
