<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\BannedUser;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();
        
        if(!auth()->guest()){
            if(Review::find(1)->banned(auth()->user()->id)){
                $banned = BannedUser::find(auth()->user()->id);
                return view('pages.bannedUser')->with('banned',$banned);
            }
        }
        
        return view('pages.faq')->with('faqs',$faqs);
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
        $request->validate([
            'Question' => 'required',
            'Answer' => 'required'
        ]);

        Faq::create([
            'question' => $request->input('Question'),
            'answer' => $request->input('Answer')
        ]);

        return redirect('/admin')
            ->with('message','New FAQ has been added!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        
        Faq::where('id',$id)
            ->update([
                'question' => $request->input('Question'),
                'answer' => $request->input('Answer')
            ]);

        return redirect('/admin')
            ->with('message','Faq has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::where('id',$id);
        $faq->delete();

        return redirect('/admin')
        ->with('message','Faq was succesfuly deleted!');
    }

    public function find($id)
    {
        $faq = Faq::find($id);

        return view('pages.editFAQ')->with('faq',$faq);
    }

    public function addFaqPage($id)
    {
        $faq = Faq::find($id);

        return view('pages.addFAQ')->with('faq',$faq);
    }
}
