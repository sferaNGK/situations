<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Category;
use App\Models\Answer;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function regPage(){
        return view('reg');
    }

    public function admin(){
        $categories = Category::all();
        return view('admin', compact('categories'));
    }

    public function welcome(){
        return view('welcome');
    }

    public function situationPage($id){
        $category = Category::query()->where('id', $id)->first();
        $question = Question::query()->where('category_id', $id)->first();
        $categories = Category::all();
        $questions = Question::query()->where('category_id', $id)->latest('created_at')->get();
        return view('situations', compact('questions', 'categories', 'question', 'category'));
    }

    public function detail($id){
        $category = Category::query()->where('id', $id)->first();
        $question = Question::find($id);
        $answers = Answer::query()->where('question_id', $id)->get();
        return view('detail', compact('question', 'category', 'answers'));
    }

    public function category(){
        if(session('categories')){
            $categories = session('categories');
        }else{
            $categories = Category::query()->latest('created_at')->get();
        }
        return view('category', compact('categories'));
    }

    public function add(Category $category){

        // $questions = question::all();
        // $category = Category::query()->where('id', $id)->first();
        // $question = question::query()->where('id', $question->id)->first();
        return view('add_situations', compact('category'));
    }
}
