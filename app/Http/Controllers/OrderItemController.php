<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shop;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderItemController extends Controller
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
    public function create(Table $table, Item $item)
    {
        return View('orderItems.create', ['table' => $table, 'item' => $item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Table $table, Item $item, Request $request)
    {
        $request->validate([
            'quantity' => 'required|max:250',
        ]);
        $orderItem = $table->currentOrder()->orderItems->where('item_id', $item->id)->where('is_sent', false)->first();

        if (!$orderItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $table->currentOrder()->id;
            $orderItem->item_id = $item->id;
            $orderItem->quantity = $request->quantity;
            $orderItem->save();
        } else {
            $orderItem->quantity += $request->quantity;
            $orderItem->save();
        }
        return redirect()->route('management', $table->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table, Item $item, OrderItem $orderItem)
    {
        return View('orderItems.edit', ['table' => $table, 'item' => $item, 'orderItem' => $orderItem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table, Item $item, OrderItem $orderItem)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0.050|max:250',
        ]);

        $orderItem->quantity = $request->quantity;
        $orderItem->save();
        return redirect()->route('management', $table->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table, Item $item, OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('management', $table->id);
    }

    public function sendOrderItems(Table $table)
    {
        foreach ($table->currentOrder()->orderItems->where('is_sent', false) as $orderItem) {
            $previousOrderItem = $table->currentOrder()->orderItems->where('item_id', $orderItem->item_id)->where('is_sent', true)->first();
            if ($previousOrderItem) {
                $previousOrderItem->quantity += $orderItem->quantity;
                $previousOrderItem->save();
                $orderItem->delete();
            } else {
                $orderItem->is_sent = true;
                $orderItem->save();
            }
        }
        return redirect()->route('management', $table->id);
    }
}
