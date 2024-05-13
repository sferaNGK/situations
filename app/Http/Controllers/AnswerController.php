<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function getAnswer(){
        $answers = Answer::all();
        foreach($answers as &$answer){
            if (isset($answer['answer_file'])) {
                $answer['answer_file'] = asset($answer['answer_file']);
            }

        };
        return response()->json($answers);
    }


    public function getAnswersDetail(Request $request){
        $answer = Answer::query()->where('question_id', $request->id)->get();
        return response()->json($answer);
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


    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        $answer = Answer::all();
        return response()->json($answer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnswerOne $answerOne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnswerOne $answerOne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnswerOne $answerOne)
    {
        //
    }
}
