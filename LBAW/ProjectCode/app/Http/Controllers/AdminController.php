<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Author;
use App\Models\BannedUser;
use App\Models\Shipped;
use App\Models\User;
use App\Models\Order;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( auth()->guest() || auth()->user()->id != 1 ){
            abort(403);
        }
        //$products = Product::all();
        $products = DB::table('product')
        ->join('product_author','product.id','=','product_author.product_id')
        ->join('author','author.id','=','product_author.author_id')
        ->join('product_genre','product.id','=','product_genre.product_id')
        ->join('genre','genre.id','=','product_genre.genre_id')
        ->select('product.id','product.product_name','product.price','product.stock','product.discount' ,'product.star_rating','product.synopsis','product.book_width','product.book_height'
                ,'product.prod_type','product.language_id','product.editor_id' ,'author.name as authorName','genre.name as genreName')
        ->get();
        $genres = DB::table('product')
        ->join('product_genre','product.id','=','product_genre.product_id')
        ->join('genre','genre.id','=','product_genre.genre_id')
        ->select('*')
        ->get();
        //dd($products);

        $faq = Faq::all();

        
        

        $bannedUser = BannedUser::all();




        $bUsers = DB::table('banned_user')
        ->join('user','banned_user.id_user','=','user.id')
        ->select('user.name','user.username','banned_user.reason','banned_user.id_user')
        ->get();
        $BUserIds = DB::table('banned_user')
            ->select('id_user')
            ->get();
        $users = DB::table('user')
                    ->select('user.name','user.username','user.email','user.id')
                    ->whereNotIn('user.id', $BUserIds->pluck('id_user'))
                    ->get();
                    
        
        $orders_payment_pending = DB::table('order')
        ->join('payment_pending','order.id','=','payment_pending.order_id')
        ->select('*')
        ->get();
        $orders_processing = DB::table('order')
        ->join('processing','order.id','=','processing.order_id')
        ->select('*')
        ->get();
        $orders_shipped = DB::table('order')
        ->join('shipped','order.id','=','shipped.order_id')
        ->select('*')
        ->get();

        $orders_delivered = DB::table('order')
        ->join('delivered','order.id','=','delivered.order_id')
        ->select('*')
        ->get();

        $orders_returned = DB::table('order')
        ->join('returned','order.id','=','returned.order_id')
        ->select('*')
        ->get();
        //$ships = Shipped::find(4);

        //dd($orders);

        //dd($products);
        return view('pages.admin')
            ->with('products',$products)
            ->with('users',$users)
            ->with('orders_payment_pending',$orders_payment_pending)
            ->with('orders_processing',$orders_processing)
            ->with('orders_shipped',$orders_shipped)
            ->with('orders_delivered',$orders_delivered)
            ->with('orders_returned',$orders_returned)
            ->with('faq',$faq)
            ->with('busers',$bUsers);
    }

    public function find(int $id)
    {
        $product = Product::find($id);

        /*dd($product);*/
        return view('pages.editProduct')->with('product',$product);
    }

    public function search(Request $request)
    {
        $products = Product::paginate(12);

        $search = $request->search;

        /*dd($search);*/

        $allproducts = Product::all();



        $products_to_display = $allproducts->whereRaw("search @@ to_tsquery('simple',?)", [$search]);
        /*dd($products_to_display);*/
        return view('pages.search')->with('products',$products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
