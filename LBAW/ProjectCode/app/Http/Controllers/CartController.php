<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\BannedUser;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            if(auth()->guest()){
                return redirect('/login');
            }
            if(Review::find(1)->banned(auth()->user()->id)){
                $banned = BannedUser::find(auth()->user()->id);
                return view('pages.bannedUser')->with('banned',$banned);
            }

            $user = User::find(auth()->user()->id);

            $productInCart = $user->userCart;
            
            return view('pages.cart')->with('productIncart',$productInCart);
        }
        catch(\Exception $e){
            abort(404);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $id_prod)
    {
        try{
            if(auth()->guest()){
                return redirect('/login');
            }

            $user_id = auth()->user()->id;

            $user = User::find($user_id);

            $cartProduct = $user->userCart;            

            $result = false;
            $quant = 0;
            foreach($cartProduct as $prod){
                if($prod->id_product == $id_prod){
                    $result = true;
                    $quant = $prod->quantity;
                }
            }

            if($result){
                $getP = Cart::where('id_product','=',$id_prod)->where('id_user','=',$user_id)->update([
                    'quantity' => ($request->quantity + $quant)
                ]);
                
                return redirect('/cart');
            }
            else{

                $addCart = new Cart([
                    'id_product' => $id_prod,
                    'id_user' => $user_id,
                    'quantity' => $request->quantity
                ]);

                //dd($addCart);
                $addCart->save();

                return redirect('/cart');
            }
            
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id_prod)
    {
        try{
            $user_id = auth()->user()->id;

            $cartProd = Cart::where('id_product','=',$id_prod)->where('id_user','=',$user_id);
            
            $cartProd->delete();
            return redirect("/cart");
        }
        catch(\Exception $e){
            abort(404);
        }
    }
}
