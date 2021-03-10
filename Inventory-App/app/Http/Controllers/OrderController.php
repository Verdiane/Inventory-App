<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class OrderController extends Controller
{
    public function index() {

        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
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
            $request->image->storeAs('images/orders/', $filename, 'public');
        }else{
            $filename = null;
        }

        $filename = basename($filename);

        $order = new Order();
        $order->item_name = $request->name ;
        $order->item_image = $filename;
        $order->description = $request->description;
        $order->quantity = $request->quantity;
        $order->price = $request->price;
        $order->save();
    
        Toastr::success('Order successfully added :)','Success');
        return redirect()->route('orders.index');
    }

    public function show($id) {    
        $order = Order::findOrFail($id);
        return view('order.show', ['order' => $order]);

      }

    public function edit(Order $order){
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
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
            if ($order->item_image){
                Storage::delete('/images/orders/' . $order->item_image);
            }
            $request->image->storeAs('images/orders/', $filename, 'public');
        }else{
            if ($order->item_image) {
                $filename = $order->item_image;
            }else{
                $filename = null;
            }
        }

        $filename = basename($filename);

        $order->item_name = $request->name ;
        $order->item_image = $filename;
        $order->description = $request->description;
        $order->quantity = $request->quantity;
        $order->price = $request->price;
        $order->save();
    

        Toastr::success('Order successfully updated :)','Success');
        return redirect()->route('orders.index');
    }


    public function destroy(Order $order){

        if ($order->item_image){
            Storage::delete('images/orders/' . $order->item_image);
        }

        $order->delete();

        Toastr::success('order successfully deleted :)','Success');
        return redirect()->route('orders.index');

    }

}
