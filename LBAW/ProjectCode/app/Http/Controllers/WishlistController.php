<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BannedUser;
use App\Models\Review;

class WishlistController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(auth()->check()){

            if(!auth()->guest()){
                if(Review::find(1)->banned(auth()->user()->id)){
                    $banned = BannedUser::find(auth()->user()->id);
                    return view('pages.bannedUser')->with('banned',$banned);
                }
            }

            //fazer o acesso para ter os links das imagens tmb
            $user = User::find(auth()->user()->id);

            $products = $user->userWishlist;
        

            return view('pages.wishlist')->with('products',$products);
        }
        else {
            header("Location: /");
            exit();
            return; 
        }
    }

    public function add_product($id)
    {
        $prod_add_wish = new Wishlist;
        
        $prod_add_wish->product_id = $id;
        $prod_add_wish->id_user = auth()->user()->id;

        $prod_add_wish->save();

        return $prod_add_wish;
    }

    public function add_to_cart(int $id_prod)
    {
        $user_id = auth()->user()->id;

        $prod_add_cart = new Cart;
        
        $prod_add_cart->id_product = $id_prod;
        $prod_add_cart->id_user = $user_id;
        $prod_add_cart->quantity = 1;

        $prod_add_cart->save();

        $prod_rem = Wishlist::where('product_id','=',$id_prod)->where('id_user','=',$user_id);
        $prod_rem->delete();

        return $prod_add_cart;
    }

    public function remove_prod(int $id_prod)
    {
        try{
            $user_id = auth()->user()->id;

            $prod_rem = Wishlist::where('product_id','=',$id_prod)->where('id_user','=',$user_id);
            
            $prod_rem->delete();
            
            return $id_prod;
        }
        catch(\Exception $e){
            abort(404);
        }
    }
}