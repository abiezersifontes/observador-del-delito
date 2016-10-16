<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\Controller;
use Validator;
use App\User;

class UserController extends Controller
{


     public function getperfil(){

       return view('auth.edit');

    }

    public function postperfil(Request $request){

      $this->validate($request, [
          'name' => 'required',
          'email' => 'required',
          'password' => 'confirmed|min:6',
      ]);


      $user = User::find(\Auth::user()->id);
      $user->name = $request->name;
      $user->email = $request->email;

      if(!$request->password==''){
        $user->password = bcrypt($request->password);
      }

      $user->save();

      return redirect()->route('inicio');

    }

    public function getRegister(){

      return view('auth.register');

   }


    public function postRegister(Request $request){

      $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|confirmed|min:6'
      ]);

      $user = new User([
         'name' => $request['name'],
         'email' => $request['email'],
         'password' => bcrypt($request['password'])
      ]);
      $user->role = 'user';
      $user->save();

      return redirect()->route('inicio');

    }
}
