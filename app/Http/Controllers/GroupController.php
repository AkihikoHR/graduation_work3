<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Group;
use App\Models\User;
use App\Models\Post;
use Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $groups = Group::getAllOrderByUpdated_at();
      return view('group.index', [
      'groups' => $groups,
      ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
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
        'name' => 'required | max:100',
        'description' => 'required',
        'condition' => 'required',
        'end_date' => 'required',
      ]);
      // バリデーション:エラー
      if ($validator->fails()) {
        return redirect()
          ->route('gourp.create')
          ->withInput()
          ->withErrors($validator);
      }
      // create()は最初から用意されている関数
      // 戻り値は挿入されたレコードの情報
      $data = $request->merge(['user_id' => Auth::user()->id])->all();
      $result = Group::create($data);
      $group = $result->id;
      // ルーティング「group.index」にリクエスト送信（一覧ページに移動）
      return redirect()->route('join', ['group' => $group]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $group = Group::find($id);
         $members = $group->users;
         $data = $members->where('id',Auth::user()->id)->first();
         
         if ($data === null){
             return view('group.show', ['group' => $group, 'members' => $members]);
         } else {
             return view('group.show-joined', ['group' => $group, 'members' => $members]); 
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
         $group = Group::find($id);
         return view('group.edit', ['group' => $group]);
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
          //バリデーション
           $validator = Validator::make($request->all(), [
            'name' => 'required | max:100',
            'description' => 'required',
            'condition' => 'required',
            'end_date' => 'required',
          ]);
          //バリデーション:エラー
          if ($validator->fails()) {
            return redirect()
              ->route('group.edit', $id)
              ->withInput()
              ->withErrors($validator);
          }
          //データ更新処理
          $result = Group::find($id)->update($request->all());
          return redirect()->route('group.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $result = Group::find($id)->delete();
         return redirect()->route('group.admin');
    }
    
    public function admin()
    {
        // Userモデルに定義した関数を実行する．
        $user_id = Auth::user()->id;
        $groups = User::find($user_id)->admin;
        
        return view('group.admin', [
          'groups' => $groups
          ]);
    }
    
    public function mygroup()
    {
        // Userモデルに定義した関数を実行する．
        $user_id = Auth::user()->id;
        $groups = User::find($user_id)->mygroups;
    
          return view('group.mygroup', [
          'groups' => $groups
          ]);
    }
    
    public function room($id)
    {
         $group = Group::find($id);
         $posts = Group::find($id)->group_posts;
         $members = Group::find($id)->users;
         return view('group.room',[
           'group' => $group,
           'posts' => $posts,
           'members' => $members
           ]);
    }
    
}



