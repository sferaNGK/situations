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
        $question = Question::query()->where('id',$request->id)->first();
        return response()->json($question);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {
        // dd($request->all());
        /**
         * 1. Создаём вопрос. Получаем его ID.
         * 2. В цикле перебираем все ответы, и каждый записываем в БД.
         *
         */
        $request->validate([
            'answer_text.0' => 'required_without:answer_file.0',
            'answer_file.0' => 'required_without:answer_text.0',
            'answer_text.1' => 'required_without:answer_file.1',
            'answer_file.1' => 'required_without:answer_text.1',
            'text' => 'required_without:file',
            'file' => 'required_without:text',
            'explain'=>'required',
            'help'=>'required',
            'right'=>'required',
        ],
        [
            'answer_text.0.required_without'=>'Поле обязательно для заполнения, если файл отсутствует',
            'answer_file.0.required_without'=>'Поле обязательно для заполнения, если текст отсутствует',
            'answer_text.1.required_without'=>'Поле обязательно для заполнения, если файл отсутствует',
            'answer_file.1.required_without'=>'Поле обязательно для заполнения, если текст отсутствует',
            'text.required_without'=>'Поле обязательно для заполнения, если файл отсутствует',
            'explain.required'=>'Поле обязательно для заполнения',
            'help.required'=>'Поле обязательно для заполнения',
            'right.required'=>'!',
        ]);

        $question = new Question();

        if($request->file('file')){
            $path = $request->file('file')->store('file');
            $question->file ='/public/storage/'.$path;
        }

        $question->text = $request->text;
        $question->type = $request->type;
        $question->category_id = $category->id;
        $question->save();

        for ($i = 0; $i < 4; $i++) {
            $answer = new Answer();
            if($request->file('answer_file.'.$i)){
                $path = $request->file('answer_file.'.$i)->store('answer_file'.$answer->id);
                $answer->answer_file ='/public/storage/'.$path;
            }
            $answer->question_id = $question->id;
            $answer->explain = $request->explain;
            $answer->help = $request->help;
            $answer->right = $request->input('right') == $i;
            $answer->answer_type = $request->input('answer_type.' . $i);
            $answer->answer_text = $request->input('answer_text.' . $i);
            $answer->save();
        }

        return redirect()->back()->with('ok', 'Ситуация сохранена');
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
    public function update(Request $request, Question $question, Answer $answer)

    {
        if($request->file('file')!==null){
            $path = $request->file('file')->store('file');
            $question->file = '/public/storage/'.$path;
            $question->text =null;
        }else{
            $question->text = $request->text;
        }
        $question->type = $request->type;
        $question->update();

        for ($i = 0; $i < 4; $i++) {

            if($request->file('answer_file.'.$i)!==null){
            $path = $request->file('answer_file.'.$i)->store('answer_file'.$answer->id);
            $answer->answer_file ='/public/storage/'.$path;
            $answer->answer_text = null;
            }else{
                $answer->answer_text = $request->input('answer_text.' .$i);
                $answer->answer_file = null;
            }
            $answer->explain = $request->explain;
            $answer->help = $request->help;
            $answer->right = $request->input('right') == $i;
            $answer->answer_type = $request->input('answer_type.' . $i);
            $answer->update();

        }
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

        dd($request->all());
        return redirect()->back();
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
