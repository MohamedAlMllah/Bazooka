<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $categories = $shop->categories;
        return view('categories.index', ['shop' => $shop, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Shop $shop, Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:250',
        ]);
        $category = new Category();
        $category->shop_id = $shop->id;
        $category->name = $request->name;
        $category->save();
        return redirect()->route('shops.categories.index', $shop->id);
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
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Shop $shop, Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:3|max:250',
        ]);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('shops.categories.index', $shop->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Category $category)
    {
        $category->delete();
        return redirect()->route('shops.categories.index', $shop->id);
    }
}
