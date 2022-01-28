<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAuthor;
use App\Models\ProductGenre;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Author;
use App\Models\User;
use App\Models\BannedUser;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try{
            if(!auth()->guest()){
                if(Review::find(1)->banned(auth()->user()->id)){
                    $banned = BannedUser::find(auth()->user()->id);
                    return view('pages.bannedUser')->with('banned',$banned);
                }
            }

            $product = Product::findOrFail((int)$id);

            if($product == null) return view('pages.404');

            $reviews = $product->getReviews()->get();

            $prodAuthor = $product->getAuthor()->get();

            $prodImages = $product->productImages()->get();

            $prodEdition = $product->getEdition()->get();

            //dd($prodEdition[0]->editionEditor()->get());

            return view('pages.product', ['product' => $product, 'reviews' => $reviews, 'prodAuthor' => $prodAuthor,'prodImages' => $prodImages, 'prodEdition' => $prodEdition]);
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
    public function store(Request $request)
    {
        
        //return view('pages.addProduct');
        //dd($request);
        try{
            $request->validate([
                'BookName' => 'required',
                'Stock' => 'required',
                'Price' => 'required',
                'Discount' => 'required'
            ]);

            $prod = Product::create([
                'product_name' => $request->input('BookName'),
                'price' => $request->input('Price'),
                'stock' => $request->input('Stock'),
                'discount' => $request->input('Discount'),
                'star_rating' => 4,
                'synopsis' => $request->input('Synopsis'), 
                'book_width' => 14, 
                'book_height' => 15, 
                'editor_id' => 15, 
                'language_id' => 2, 
                'prod_type' => 'Hard Cover Book'
            ]);

            ProductAuthor::create([
                'product_id' => $prod->id, 
                'author_id' => 1
            ]);

            ProductGenre::create([
                'product_id' => $prod->id, 
                'genre_id' => 1
            ]);

            return redirect('/admin')
                ->with('message','New Product has been added!');
        }
        catch(\Exception $e){
            abort(404);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            Product::where('id',$id)
                ->update([
                    'product_name' => $request->input('BookName'),
                    'price' => $request->input('Price'),
                    'stock' => $request->input('Stock'),
                    'discount' => $request->input('Discount'),
                    'synopsis' => $request->input('Synopsis')
                ]);

            return redirect('/admin')
                ->with('message','Product has been edited!');
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $prod = Product::where('id',$id);
            $prod->delete();

            return redirect('/admin')
            ->with('message','Product has been deleted!');
        }
        catch(\Exception $e){
            abort(404);
        }
    }

    public static function inWishlist($id)
    {
        $temp = DB::table('wishlist')
                ->where('wishlist.product_id', '=', $id)->where('wishlist.id_user', '=', auth()->user()->id)
                ->get(); 

        if(empty($temp)){
            return false;
        }
        else {
            foreach ($temp as $prod){
                if($prod->product_id == $id)
                    return true;
            }
           
            return false;
        }
    }
}
