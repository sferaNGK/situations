<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
            'title'=>['required'],
            'description'=>['required'],
        ],
        [
            'title.required'=>'Поле обязательно для заполнения',
            'description'=>'Поле обязательно для заполнения'
        ]);

        $category = new Category();
        $category->title = $request->title;
        $category->description = $request->description;
        $category->save();
        return response()->json('Категория добавлена',200);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        if (!empty($search)) {
            $categories = Category::query()
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%");
                        })->get();

            return redirect()->back()->with('categories', $categories);
        }

    }

    public function getGame(){
        return response()->json(Category::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function categoryUpdate(Request $request)
    {
        $category = Category::query()->where('id',$request->id)->first();
        $category->title = $request->title;
        $category->description = $request->description;
        return response()->json('Категория изменена',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::query()->where('id',$request->id)->first();
        $category->delete();
        return response()->json('Категория удалена',200);
    }
}
