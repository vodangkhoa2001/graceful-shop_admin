<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Danh sách danh mục';
        $category = Category::orderBy('id','DESC')->get();
        return view('component.category.category',compact('title','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('component.category.create-category');
    }
    public function postCreate(Request $request)
    {
        $image = $request->file('icon_category');
        $namewithextension = $image->getClientOriginalName();
        $fileName = explode('.', $namewithextension)[0];
        $extension = $image->getClientOriginalExtension();
        $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
        $destinationPath = public_path('/assets/img/categories/');
        $image->move($destinationPath,$fileNew);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->icon = $fileNew;
        $category->status = 1;
        $success = $category->save();
        return view('component.category.create-category',compact('success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id){
        $category = Category::find($id);
        return view('component.category.edit-category',compact('category'));
    }
    public function postEdit($id,Request $request)
    {
        $category = Category::find($id);
        if($request->hasFile('icon_category')){
            $image = $request->file('icon_category');
            $namewithextension = $image->getClientOriginalName();
            $fileName = explode('.', $namewithextension)[0];
            $extension = $image->getClientOriginalExtension();
            $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
            $destinationPath = public_path('/assets/img/categories/');
            $image->move($destinationPath,$fileNew);
            $category->icon = $fileNew;
            $category->category_name = $request->category_name;
            $category->status = $request->status;
        }
        else{
            $category->category_name = $request->category_name;
            $category->status = $request->status;
        }

        $success = $category->update();
        return view('component.category.edit-category', compact('success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
