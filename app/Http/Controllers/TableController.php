<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shop $shop)
    {
        return View('tables.create', ['shop' => $shop]);
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
            'type' => 'required|in:table,computer,playstation',
            'description' => 'nullable|min:2|max:250'
        ]);

        $table = new Table();
        $table->shop_id = $shop->id;
        $table->name = $request->name;
        $table->type = $request->type;
        $table->description = $request->description ? $request->description : null;
        $table->save();
        return redirect()->route('shops.edit', $shop->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, Table $table)
    {
        return View('tables.edit', ['shop' => $shop, 'table' => $table]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Table $table)
    {
        $request->validate([
            'name' => 'required|min:3|max:250',
            'type' => 'required|in:table,computer,playstation',
            'description' => 'nullable|min:2|max:250'
        ]);

        $table->name = $request->name;
        $table->type = $request->type;
        $table->description = $request->description ? $request->description : null;
        $table->save();
        return redirect()->route('shops.edit', $shop->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Table $table)
    {
        $table->delete();
        return redirect()->route('shops.edit', $shop->id);
    }

    public function pricing(Shop $shop, Table $table)
    {
        return View('tables.pricing', ['shop' => $shop, 'table' => $table]);
    }
    public function updatePricing(Request $request, Shop $shop, Table $table)
    {
        $request->validate([
            'singlePrice' => 'required|min:0|max:10000',
            'multiplayerPrice' => 'required_if:type,playstation|min:0|max:10000'
        ]);

        $table->single_price = $request->singlePrice;
        $table->multiplayer_price = $request->multiplayerPrice ? $request->multiplayerPrice : 0.0;
        $table->save();
        return redirect()->route('shops.edit', $shop->id);
    }
}
