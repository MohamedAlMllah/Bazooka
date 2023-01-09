<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Shop;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop, Category $category)
    {
        $items = $category->items;
        return View('items.index', ['shop' => $shop, 'category' => $category, 'items' => $items]);
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
    public function store(Shop $shop, Category $category, Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:250',
            'price' => 'required|min:0|max:10000',
            'description' => 'nullable|min:2|max:250'
        ]);

        $item = new Item();
        $item->category_id = $category->id;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description ? $request->description : null;
        $item->save();
        return redirect()->route('shops.categories.items.index', [$shop->id, $category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, Category $category, Item $item)
    {
        return View('items.edit', ['shop' => $shop, 'category' => $category, 'item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Category $category, Item $item)
    {
        $request->validate([
            'name' => 'required|min:3|max:250',
            'price' => 'required|min:0|max:10000',
            'description' => 'nullable|min:2|max:250'
        ]);

        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description ? $request->description : null;
        $item->save();
        return redirect()->route('shops.categories.items.index', [$shop->id, $category->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Category $category, Item $item)
    {
        $item->delete();
        return redirect()->route('shops.categories.items.index', [$shop->id, $category->id]);
    }
}
