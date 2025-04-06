<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function inventory_list(){
        $inventoreis = Inventory::with('rel_to_color','rel_to_size')->get();
        $product = Product::all();
        return view('admin.inventory.inventory_list',compact('inventoreis','product'));
    }

    public function inventory_create($id){
        $product = Product::find($id);
        $colors = Color::all();
        return view('admin.inventory.inventory_add',compact('product','colors'));
    }

    public function inventory_store(Request $request,$id){
        $request->validate([
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required',
        ]);

        if(Inventory::where('product_id',$id)->where('color_id',$request->color_id)->where('size_id', $request->size_id)->exists())
        {
            Inventory::where('product_id',$id)->where('color_id',$request->color_id)->where('size_id', $request->size_id)->increment('quantity',$request->quantity);
            return back();
        }

        Inventory::create([
            'product_id' => $id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('inventory.list')->with('success','Inventory Added!');
    }

    public function inventory_delete($id){
        Inventory::find($id)->delete();
        return back();
    }
}
