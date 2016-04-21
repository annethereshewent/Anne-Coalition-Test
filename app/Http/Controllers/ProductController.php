<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\TwodialogUser;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Auth;
use Mail;
use Session;
use Illuminate\Support\Facades\Hash;

//use Illuminate\Support\Facades\View;

class ProductController extends Controller {
  
  public function editProduct(Request $request) {
    return view('product');
  }
  
  public function updateProduct(Request $request) {
    if (!is_numeric($request->input('quantity')) || !is_numeric($request->input('price'))) {
      return Redirect::to('/')
        ->withErrors(["The quantity and price must be numeric values."]);
    }
    
    $return_array = [
      'Product_Name' => $request->input('name'),
      'Quantity_In_Stock' => $request->input('quantity'),
      'Price_Per_Item' => $request->input('price'),
      'Datetime_Submitted' => date('m/d/Y h:i:s'),
      'Total_Value' => (int)$request->input('quantity') * (int)$request->input('price')
    ];
    
    $fp = fopen('productJson_'.date('Ymdhis').'json', 'w');
    
    fwrite($fp, json_encode($return_array));
    
    fclose($fp);
    
    return Redirect::to('/')
      ->with('product_return', $return_array)
      ->withInput();
  }
  
}