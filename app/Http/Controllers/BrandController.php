<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class BrandController extends Controller
{
    //
    public function add_brand(Request $request)
      {
          $rules = array(
                  'brand_name' => 'required'
          );
          $validator = Validator::make(Input::all(), $rules);
          if ($validator->fails()) {
              return Response::json(array(
                      'errors' => $validator->getMessageBag()->toArray(),
              ));
          } else {
              $data = new Brand();
              $data->brand_name = $request->brand_name;
              $data->save();
              return redirect()->back()->with('success','Brand successfully added!');
          }
      }
      public function read_brand(Request $req)
      {
          $data_brand = Brand::get();
  
          return view('admin.brands',compact('data_brand'));
          //return view('admin.home')->withData($data);
          
      }
      public function edit_brand(Request $request)
      {
        //   $data = Brand::find($req->id);
        //   $data->brand_name = $req->brand_name; 
        //   $data->save();

        if($request->ajax()){
            Brand::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            dd($request);
            
            return response()->json(['success' => true]);
        }
  
          //return response()->json($data);
      }
      public function delete_brand(Request $req)
      {
            Brand::find($req->id)->delete();
  
          return response()->json();
      }
}
