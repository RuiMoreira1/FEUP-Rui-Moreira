<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\BannedUser;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            if(!auth()->guest()){
                if(Review::find(1)->banned(auth()->user()->id)){
                    $banned = BannedUser::find(auth()->user()->id);
                    return view('pages.bannedUser')->with('banned',$banned);
                }
            }

            $productReviews = Review::find(1);

            dd($productReviews->productReviews);

            return view('pages.test');
        }
        catch(\Exception $e){
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->route('id');
        
        return view('pages.createRev')->with('id',$id)
;    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if(auth()->guest()){
                return redirect('/login');
            }
    
            $data = $request->validate([
                'comment' => 'required|max:240',
                'rating' => 'required|numeric|between:0,5',
    
            ]);
    
            $product_id = intval($request->route('id'));
    
            $review = new Review([
                'comment' => $request->comment,
                'star_rating' => $request->rating,
                'id_user' => auth()->user()->id,
                'id_product' => $request->route('id')
            ]);
    
            $review->save();
    
            return redirect("/product/$product_id");
        }
        catch(\Exception $e){
            abort(404);
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $rev, $id, $review)
    {
        //dd($id);
        //dd($review);

        $review = Review::find($review);

        //dd($review);

        return view('pages.editRev')->with('review',$review)->with('id',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review, int $id, int $prod_id)
    {
        $dataEdit = $request->validate([
            'commentEdit' => 'required|max:240',
            'ratingEdit' => 'required|numeric|between:0,5',

        ]);
         
        $review = Review::where('id', $id)->update([
            'comment' => $request->commentEdit,
            'star_rating' => $request->ratingEdit, 
        ]);

        return redirect("/product/$prod_id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, int $id_prod)
    {
        try{
            $review = Review::findOrFail($id);

            $review->delete();

            return redirect("/product/$id_prod");
        }
        catch(\Exception $e){
            abort(404);
        }
    }
}
