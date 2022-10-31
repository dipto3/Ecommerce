<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use Darryldecode\Cart\Cart as CartCart;
use Session;

Session_start();
class CartController extends Controller
{

   
    public function add_to_cart(Request $request){
     $quantity = $request->quantity;
     $id = $request->id;

    //  $products =DB::table('products')->where('id',$id)->first();

     $products = Product::where('id',$id)->first();
     $data['quantity'] = $quantity;
     $data['id'] = $products->id;
     $data['name'] = $products->name;
     $data['price'] = $products->price;
     $data['attributes'] = [$products->image];

     \Cart::add($data);
     cardArray();
     return redirect()->back();


    // {
    //     \Cart::add([
    //         'id' => $request->id,
    //         'name' => $request->name,
    //         'price' => $request->price,
    //         'quantity' => $request->quantity,
    //         'attributes' => array(
    //             'image' => $request->product->image,
    //         )
    //     ]);
    //     session()->flash('success', 'Product is Added to Cart Successfully !');

    //     return redirect()->back();
    // }
    }
public function delete($id){
    Cart::remove($id);
    return redirect()->back();

}


}
