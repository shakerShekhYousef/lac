<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Question;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        return FaqResource::collection(Question::paginate(10));

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'question'=>'required|string',
            'answer'=>'required|string',
            'question_ar'=>'string',
            'answer_ar'=>'string',
        ]);
        $question=new Question();
        $question->question=$request->question;
        $question->answer=$request->answer;
        $question->question_ar=$request->question_ar;
        $question->answer_ar=$request->answer_ar;
        $question->save();
        if ($question){
            return response()->json('Question Created',200);
        }
    }


    public function show(Question $question)
    {
        return response()->json($question,200);
    }


    public function edit(Question $question)
    {
        return response()->json($question,200);
    }


    public function update(Request $request, Question $question)
    {
        $this->validate($request,[
            'question'=>'string'
        ]);
        $question->question=$request->question;
        $question->answer=$request->answer;
        $question->question_ar=$request->question_ar;
        $question->answer_ar=$request->answer_ar;
        $question->save();
        if ($question){
            return response()->json('Question Updated',200);
        }
    }


    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json('Question Deleted',200);
    }
}
