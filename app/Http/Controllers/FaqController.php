<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        $questions = Question::orderBy('created_at','desc')->get();
        return view('questions.index', compact('questions'));
    }

// create question
    public function create()
    {
        return view('questions.create');
    }

// create answer
    public function createAnswer(Question $question)
    {
        return view('answers.create', compact('question'));

    }

// store question
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|string',
            'answer_ar' => 'required|string',
            'question_ar' => 'required|string',
            'answer' => 'required|string',
        ]);
        $question = new Question();
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->question_ar = $request->question_ar;
        $question->answer_ar = $request->answer_ar;
        $question->save();
        return redirect()->back()->withstatus(__('alerts.backend.question.created'));
    }

// store answer
    public function storeAnswer(Request $request)
    {

        $this->validate($request, [
            'answer' => 'required|string'
        ]);
        $answer = new Answer();
        $answer->answer = $request->answer;
        $answer->question_id = $request->question_id;
        $answer->save();
        return redirect()->back()->withstatus('Answer Created');
    }

// show question
    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

// show answer
    public function showAnswer(Answer $answer)
    {
        return view('answers.show', compact('answer'));
    }

// edit question
    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

// edit answer
    public function editAnswer(Answer $answer)
    {
        return view('answers.edit', compact('answer'));
    }

// update question
    public function update(Request $request, Question $question)
    {
        $this->validate($request, [
            'question' => 'string',
            'question_ar' => 'string',
            'answer_ar'=>'string',
            'answer'=>'string'
        ]);
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->question_ar = $request->question_ar;
        $question->answer_ar = $request->answer_ar;
        $question->save();
        return redirect()->back()->withstatus(__('alerts.backend.question.updated'));
    }

// update answer
    public function updateAnswer(Request $request, Answer $answer)
    {
        $this->validate($request, [
            'answer' => 'string'
        ]);
        $answer->answer = $request->answer;
        $answer->save();
        return redirect()->back()->withstatus(__('Answer Updated'));
    }

// Question destroy
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back()->withstatus(__('alerts.backend.question.deleted'));
    }

// Answer destroy
    public function destroyAnswer(Answer $answer)
    {
        $answer->delete();
        return redirect()->back()->withstatus('Answer Deleted');
    }
}
