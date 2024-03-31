<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
        ],
        [
            'title.required'=>'Поле обязательно для заполнения',
        ]);

        $category = new Category();
        $category->title = $request->title;
        $category->save();
        return redirect()->back();
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

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
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
    public function update(Request $request, Category $category)
    {
        $category->title = $request->title;
        $category->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
