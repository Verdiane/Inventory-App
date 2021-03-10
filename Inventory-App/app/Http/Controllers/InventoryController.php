<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;


class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $inventories = Inventory::all();
        return view('inventories.index', compact('inventories'));

    }

    public function create(){
        return view('inventories.create');
    }

    public function order(){
        return view('inventories.order');
    }

    public function store(Request $request)
    {
        $this -> validate($request, [
            "name" => 'required',
            "description" => 'required',
            "quantity" => 'required',
            "price" => 'required'
        ]);

        if($request->hasFile('image')){
            $filename  = $request->image->getClientOriginalName();
            $request->image->storeAs('images/inventories', $filename, 'public');
        }
        else{
            $filename = null;
        }

        $filename = basename($filename);

        $inventory = new Inventory();
        $inventory->id = $request->id;
        $inventory->item_image = $filename;
        $inventory->item_name = $request->name;
        $inventory->description = $request->description;
        $inventory->quantity = $request->quantity;
        $inventory->price = $request->price;
        $inventory->save();

        Toastr::success('Item successfully added to the Inventory list :)','Success');
        return redirect()->route("inventories.index");
    }

    public function show($id) {    
        $inventory = Inventory::findOrFail($id);
        return view('inventories.show', ['inventory' => $inventory]);

      }

    public function edit(Inventory $inventory){
        return view('inventories.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $this -> validate($request, [
            "name" => 'required',
            "description" => 'required',
            "quantity" => 'required',
            "price" => 'required'
        ]);

        //Upload image if present
        if ($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            if ($inventory->item_image){
                Storage::delete('/images/inventories/' . $inventory->item_image);
            }
            $request->image->storeAs('images/inventories', $filename, 'public');
        }else{
            if ($inventory->item_image) {
                $filename = $inventory->item_image;
            }else{
                $filename = null;
            }
        }

        $filename = basename($filename);

        $inventory->item_name = $request->name ;
        $inventory->item_image = $filename;
        $inventory->description = $request->description;
        $inventory->quantity = $request->quantity;
        $inventory->price = $request->price;
        $inventory->save();
    
        Toastr::success('Item successfully updated :)','Success');
        return redirect()->route('inventories.index');
    }


    public function destroy(Inventory $inventory){
        // $inventory = Inventory::findorfail($id);

        if ($inventory->item_image){
            Storage::delete('images/inventories/'. $inventory->item_image);
        }

        $inventory->delete();

        Toastr::success('item successfully deleted :)','Success');
        return redirect()->route('inventories.index');

    }

}


