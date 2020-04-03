<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Productpic;
use App\Brand;
use App\Credit;
class ItemController extends Controller
{
    //
    public function add_item(Request $req){
            
            $data_product = new Product();
            $data_product->product_name = $req->product_name;
            $data_product->brand = $req->brand;
            $data_product->model = $req->model;
            $data_product->quantity = $req->quantity;
            $data_product->unit_price = $req->unit_price;
            $data_product->cash_price = $req->cash_price;
            $data_product->status = 'active';
            $data_product->save();

            $image = $req->file('input_img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/productimg');
            $image->move($destinationPath, $name);
            $data_pic = new Productpic();
            $data_pic->product_id = $data_product->id;
            $data_pic->file_name = $name;
            $data_pic->save();

            return redirect()->back()->with('success','Item successfully added!');
            
    }
    public function add_product_image(Request $req){

        $image = $req->file('input_img');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/productimg');
        $image->move($destinationPath, $name);
        $data_pic = new Productpic();
        $data_pic->product_id = $req->product_id;
        $data_pic->file_name = $name;
        $data_pic->save();

        return redirect()->back()->with('success','Product Image successfully added!');
        
}

    public function edit_item(Request $request){

        if($request->ajax()){
            Product::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            dd($request);
            
            return response()->json(['success' => true]);
        }
    }
    public function view_item($item_id){
        $data_brand = Brand::get();
        $brands = [];
        foreach($data_brand as $brand){
            $array_brand = ['value' => $brand->id, 'text' => $brand->brand_name];
            array_push($brands, $array_brand);
        }
        $data_credit = Credit::where('product_id', '=', $item_id)->with('account', 'product')->paginate(50);
        $data_picture = Productpic::where('product_id', '=', $item_id)->get();
        $data_item = Product::where('id', '=', $item_id)
            ->with('pic', 'branddetails')
            ->first();
        //dd($data_item);
        return view('admin.item', compact('data_item', 'data_brand', 'brands', 'data_picture', 'data_credit'));
    }
}

