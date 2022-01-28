<?php

namespace App\Http\Controllers;


use App\Models\BannedUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Shows the user for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $user = User::find($id);

      $this->authorize('show', $user);
      return view('pages.profile', ['user' => $user]);
    }

    public function ban($id,Request $request)
    {
      //return view('pages.addProduct');
      //dd($request);

      $request->validate([
          'Reason' => 'required'
      ]);

      $noice = BannedUser::create([
          'id_user' => $id,
          'reason' => $request->input('Reason')
      ]);

      
      return redirect('/admin')->with('message','User is now banned!');
    }

    public function banProduct($id, $prodId, Request $request)
    {
      $request->validate([
        'Reason' => 'required'
      ]);

      $noice = BannedUser::create([
          'id_user' => $id,
          'reason' => $request->input('Reason')
      ]);

      return redirect("/product/$prodId");
    }

    public function banUserPage($id)
    {
      $user = User::find($id);

      
      return view('pages.banUser')->with('user',$user);
    }

    public function unBan($id)
    {
        
        $user = BannedUser::where('id_user',$id);
        $user->delete();

        return redirect('/admin')
        ->with('message','User is now unbanned!');
    }

    public function deleteUser($id){
      $user = User::where('id',$id);
        $user->delete();

        return redirect('/admin')
        ->with('message','User was succesfuly deleted!');
    }

    


    public function isAdmin(){
      return User::find($id) == 1;
    }
}
