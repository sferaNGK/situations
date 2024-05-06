<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Category;
use App\Models\Answer;
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

    public function getQuestion(){
        $questions = Question::all();
        foreach($questions as &$question){
            if (isset($question['file'])) {
                $question['file'] = asset($question['file']);
            }

        };
        return response()->json($questions);
    }

    public function getQuestions(Request $request){
        $question = Question::query()->where('category_id',$request->id)->get();
        return response()->json($question);
    }
    public function getAnswers(Request $request){
        $answers = [];
        $question = Question::query()->where('category_id',$request->id)->get();
        foreach($question as $que){
            array_push($answers, Answer::with('question')->where('question_id',$que->id)->get());
        }
        return response()->json($answers);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {

        /**
         * 1. Создаём вопрос. Получаем его ID.
         * 2. В цикле перебираем все ответы, и каждый записываем в БД.
         *
         */
        $request->validate([
            'right'=>'required',
        ],
        [
            'right.required'=>'!',
        ]);

        $question = new Question();

        if($request->file('file')){
            $question->file = '/storage/'.$request->file('file')->store('/public/img');
            $question->file = str_replace('public/',"",$question->file);
        }

        $question->text = $request->text;
        $question->type = $request->type;
        $question->category_id = $category->id;
        $question->save();

        for ($i = 0; $i < 4; $i++) {
            $answer = new Answer();
            if($request->file('explain_file')){
                $answer->explain_file = '/storage/'.$request->file('explain_file')->store('/public/explain');
                $answer->explain_file = str_replace('public/',"",$answer->explain_file);
            }
            if($request->file('help_file')){
                $answer->help_file = '/storage/'.$request->file('help_file')->store('/public/help');
                $answer->help_file = str_replace('public/',"",$answer->help_file);
            }
            $answer->question_id = $question->id;
            $answer->explain = $request->input('explain');
            $answer->explain_type = $request->explain_type;
            $answer->help_type = $request->help_type;
            $answer->help = $request->input('help');
            $answer->right = $request->input('right') == $i;
            $answer->answer_text = $request->input('answer_text.' . $i);
            $answer->save();
        }

        return redirect()->route('situationPage', $category->id)->with('ok', 'Ситуация сохранена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)

    {
        if($request->file('file')!==null){
            // $path = $request->file('file')->store('file');
            // $question->file = '/public/storage/'.$path;

            $question->file = '/storage/'.$request->file('file')->store('/public/img');
            $question->file = str_replace('public/',"",$question->file);

            $question->text =null;
        }else{
            $question->text = $request->text;
        }
        $question->type = $request->type;
        $question->update();

        $answers = Answer::query()->where('question_id',$question->id)->get();

        foreach($answers as $key => $answ){
            if($request->file('answer_file.'.$key)!==null){

                // $path = $request->file('answer_file.'.$i)->store('answer_file'.$answer->id);
                // $answer->answer_file ='/public/storage/'.$path;

                $answ->answer_file = '/storage/'.$request->file('answer_file' . $key)->store('/public/answer');
                $answ->answer_file = str_replace('public/',"",$answ->answer_file);

                $answ->answer_text = null;
                }else{
                    $answ->answer_text = $request->input('answer_text.' .$key);
                    $answ->answer_file = null;
                }
                $answ->explain = $request->explain;
                $answ->help = $request->help;
                if($request->input('right')){
                    $answ->right = $request->input('right') == $key;
                }
                $answ->answer_type = $request->input('answer_type.' . $key);
                $answ->update();
        }



        // for ($i = 0; $i < 4; $i++) {

        //     if($request->file('answer_file.'.$i)!==null){

        //     // $path = $request->file('answer_file.'.$i)->store('answer_file'.$answer->id);
        //     // $answer->answer_file ='/public/storage/'.$path;

        //     $answer->answer_file = '/storage/'.$request->file('answer_file' . $i)->store('/public/answer');
        //     $answer->answer_file = str_replace('public/',"",$answer->answer_file);

        //     $answer->answer_text = null;
        //     }else{
        //         $answer->answer_text = $request->input('answer_text.' .$i);
        //         $answer->answer_file = null;
        //     }
        //     $answer->explain = $request->explain;
        //     $answer->help = $request->help;
        //     $answer->right = $request->input('right') == $i;
        //     $answer->answer_type = $request->input('answer_type.' . $i);
        //     $answer->update();

        // }


        // $answers = Answer::query()->where('question_id', $question->id)->get();
        // foreach ($answers as $answer) {

        //     $id = $answer->id;
        //     if($request->file('answer_file.'.$id)!==null){
        //         $path = $request->file('answer_file.'.$id)->store('answer_file'.$id);
        //         $answer->answer_file = '/public/storage/'.$path;
        //         $answer->answer_text = null;
        //     } else {
        //         $answer->answer_text = $request->input('answer_text.' .$id);
        //         $answer->answer_file = null;
        //     }

        //     $answer->explain = $request->explain;
        //     $answer->help = $request->help;
        //     $answer->right = $request->input('right') == $id;
        //     $answer->answer_type = $request->input('answer_type.' . $id);
        //     $answer->update();
        // }
        return redirect()->route('situationPage', $question->category_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back();
    }
}
