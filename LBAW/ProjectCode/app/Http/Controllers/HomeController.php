<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Quote;
use App\Models\User;
use App\Models\BannedUser;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(!auth()->guest()){
            if(Review::find(1)->banned(auth()->user()->id)){
                $banned = BannedUser::find(auth()->user()->id);
                return view('pages.bannedUser')->with('banned',$banned);
            }
        }
        //fazer o acesso para ter os links das imagens tmb
        $prod_Top10_query = DB::table('product')
                        ->select('product.id')
                        ->orderby('star_rating', 'desc')
                        ->take(10)
                        ->get();
                    
        $top10 = [];
        foreach($prod_Top10_query as $p){
            array_push($top10, Product::find($p->id));
        }
        
        $quotes = DB::table('quote')
                    ->select('quote')->get();
        
        return view('pages.home', ['products'=> Product::all() ,'quotes' => $quotes, 'top10' => $top10]);
    }

    public function harry_potter()
    {
        $search = str_replace(' ',' & ', 'Harry Potter');

        $products = Product::whereRaw("search @@ to_tsquery('english',?)", [$search])->paginate(12);

        $total = Product::whereRaw("search @@ to_tsquery('english',?)", [$search])->get();

        return view('pages.search')->with('total',$total)->with('products', $products);
    }

}