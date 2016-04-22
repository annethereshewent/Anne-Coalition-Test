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

    if ($request->input('name') == '') {
      return Redirect::to('/')
        ->withErrors(['Please enter a product name.'])
        ->withInput();
    }
    if (!is_numeric($request->input('quantity')) || !is_numeric($request->input('price'))) {
      return Redirect::to('/')
        ->withErrors(["The quantity and price must be numeric values."]);
    }
    
    $new_product = [
      'name' => $request->input('name'),
      'quantity' => $request->input('quantity'),
      'price' => $request->input('price'),
      'date' => date('m/d/Y h:i:s'),
      'total' => (int)$request->input('quantity') * (double)$request->input('price')
    ];
    
    //fetch the current products from the json file, decode, add new product, and encode again.
    
    $current_products = file_exists('productJson.json') ? json_decode(file_get_contents('productJson.json')) : [];
    
    $current_products[] = $new_product;
    
    $fp = fopen('productJson.json', 'w');
    
    $json_return = json_encode($current_products);
    
    fwrite($fp, $json_return);
    
    fclose($fp);
    
  
    
    echo $json_return;
    exit;
  }
  
}