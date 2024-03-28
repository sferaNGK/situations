<?php

namespace App\Http\Controllers;

use App\Models\question;
use App\Models\Category;
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

    public function situationPage(){
        $categories = Category::all();
        $questions = question::query()->latest('created_at')->get();
        return view('situations', compact('questions', 'categories'));
    }

    public function detail($id){
        $question = question::find($id);
        return view('detail', compact('question'));
    }

    public function category(){
        $categories = Category::query()->latest('created_at')->get();
        return view('category', compact('categories'));
    }
}
