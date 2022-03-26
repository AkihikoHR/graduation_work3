<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Question;
use App\Models\Group;
use Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $group_id = $request->group_id;
        // バリデーション
        $validator = Validator::make($request->all(), [
            'question' => 'required | max:100',
            'image' => 'image | file',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('group.room', $group_id)
                ->withInput()
                ->withErrors($validator);
        }
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        
        
        if ($file = $request->image) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }

        $question = new Question;
        $question->user_id = Auth::user()->id;
        $question->group_id = $request->group_id;
        $question->question = $request->question;
        $question->description = $request->description;
        $question->image = $fileName;
        $question->save();

        // ルーティング「tweet.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('group.room', $group_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $question = Question::find($id);
         $group_id = $question->group_id;
         $group = Group::find($group_id);
         return view('question.show', [
           'question' => $question,
           'group' => $group
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $group_id = Question::find($id)->group_id;
         $result = Question::find($id)->delete();
         return redirect()->route('group.room',$group_id);
    }
}
