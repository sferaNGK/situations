<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text'=>['required'],
            'text_right'=>['required'],
            'answer_one'=>['required'],
            'answer_three'=>['required'],
            'answer_two'=>['required'],
        ],
        [
            'text.required'=>'Поле обязательно для заполнения',
            'text_right.required'=>'Поле обязательно для заполнения',
            'answer_one.required'=>'Поле обязательно для заполнения',
            'answer_three.required'=>'Поле обязательно для заполнения',
            'answer_two.required'=>'Поле обязательно для заполнения',
        ]);

        $question = new question();
        $question->text = $request->text;
        $question->text_right = $request->text_right;
        $question->answer_one = $request->answer_one;
        $question->answer_three = $request->answer_three;
        $question->answer_two = $request->answer_two;
        $question->category_id = $request->category;
        $question->save();
        return redirect()->back()->with('ok', 'Ситуация сохранена');
    }

    /**
     * Display the specified resource.
     */
    public function show(question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, question $question)
    {
        $question->text = $request->text;
        $question->text_right = $request->text_right;
        $question->answer_one = $request->answer_one;
        $question->answer_two = $request->answer_two;
        $question->answer_three = $request->answer_three;
        $question->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(question $question)
    {
        $question->delete();
        return redirect()->back();
    }
}
