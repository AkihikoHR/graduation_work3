<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Answer;
use App\Models\Question;
use Auth;

class AnswerController extends Controller
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

        // return view('answer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question_id = $request->question_id;
        // バリデーション
        $validator = Validator::make($request->all(), [
            'answer' => 'required' ,
            'image' => 'image | file',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('answer.reply', $question_id)
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

        $answer = new Answer;
        $answer->user_id = Auth::user()->id;
        $answer->question_id = $question_id;
        $answer->answer = $request->answer;
        $answer->image = $fileName;
        $answer->save();

        // ルーティング「tweet.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('question.show',$question_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
         $question_id = Answer::find($id)->question_id;
         $result = Answer::find($id)->delete();
         return redirect()->route('question.show',$question_id);
    }
    
    public function reply($id)
    {
         $question = Question::find($id);
         return view('answer.reply',[
             'question' => $question
         ]);
    }
}
