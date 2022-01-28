<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\BannedUser;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->guest()){
            if(Review::find(1)->banned(auth()->user()->id)){
                $banned = BannedUser::find(auth()->user()->id);
                return view('pages.bannedUser')->with('banned',$banned);
            }
        }

        $products = Product::paginate(12);

        //dd($products);
        return view('pages.search')->with('products',$products);
    }

    public function search(Request $request)
    {
        if(!auth()->guest()){
            if(Review::find(1)->banned(auth()->user()->id)){
                $banned = BannedUser::find(auth()->user()->id);
                return view('pages.bannedUser')->with('banned',$banned);
            }
        }
        
        $search = $request->search;

        $search = str_replace(' ',' & ', $search);

        $products = Product::whereRaw("search @@ to_tsquery('english',?)", [$search])->paginate(12);

        $total = Product::whereRaw("search @@ to_tsquery('english',?)", [$search])->get();

        return view('pages.search')->with('total',$total)->with('products', $products);

    }
}
