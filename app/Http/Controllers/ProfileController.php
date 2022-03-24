<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Profile;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index', [
       'profiles' => []
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
         'nickname' => 'required | max:100',
         'birthday' => 'required',
         'school' => 'required',
         'grade' => 'required',
         'pref' => 'required',
          ]);
          // バリデーション:エラー
          if ($validator->fails()) {
            return redirect()
              ->route('profile.create')
              ->withInput()
              ->withErrors($validator);
          }
          // create()は最初から用意されている関数
          // 戻り値は挿入されたレコードの情報
          $profile = Auth::user()->id;
          $data = $request->merge(['user_id' => $profile])->all();
          $result = Profile::create($data);
          return redirect()->route('profile.show', ['profile' => $profile]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user = User::find($id);
         if ($id == Auth::user()->id){
            $myprofile = Profile::myprofile();
            return view('profile.show', ['profile' => $myprofile, 'user' => $user]); 
         } else {
            $guestprofile = Profile::guestprofile($id);
            return view('profile.show-public', ['profile' => $guestprofile]); 
         }
    }
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $profile = Profile::find($id);
         return view('profile.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        // バリデーション
        $validator = Validator::make($request->all(), [
         'nickname' => 'required | max:100',
         'birthday' => 'required',
         'school' => 'required',
         'grade' => 'required',
         'pref' => 'required',
          ]);
          // バリデーション:エラー
          if ($validator->fails()) {
            return redirect()
              ->route('profile.edit', $id)
              ->withInput()
              ->withErrors($validator);
          }
          // create()は最初から用意されている関数
          // 戻り値は挿入されたレコードの情報
          $result = Profile::find($id)->update($request->all());
          $profile = Profile::myprofile($id);
          $user_id = $profile->user_id;
          $user = User::find($user_id);
          return view('profile.show', ['profile' => $profile, 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
