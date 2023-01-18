<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Models\Employment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
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
    public function create()
    {
        return View('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:250',
            'address' => 'nullable|min:3|max:250',
        ]);

        $shop = new Shop();
        $shop->owner_id = $request->ownerId;
        $shop->name = $request->name;
        $shop->address = $request->address ? $request->address : null;
        $shop->save();
        $user = User::where('id', $request->ownerId)->first();
        $user->role_id = 3;
        $user->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return View('home.employee', ['employedAtShop' => $shop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return View('shops.edit', ['shop' => $shop, 'shopTables' => $shop->tables]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'name' => 'required|min:3|max:250',
            'address' => 'nullable|min:3|max:250',
        ]);

        $shop->name = $request->name;
        $shop->address = $request->address ? $request->address : null;
        $shop->save();
        return redirect()->route('shops.edit', $shop->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('home');
    }
    public function employment(Shop $shop,)
    {
        $employees = $shop->employees();
        return view('shops.employment', ['shop' => $shop, 'employees' => $employees]);
    }
    public function hire(Request $request, Shop $shop)
    {
        $employee = User::where('email', $request->email)->first() ?? null;
        if ($employee === null)
            return redirect()->route('employment', $shop->id)->with('error', 'User Not Found');
        else if ($employee->role_id == 4)
            return redirect()->route('employment', $shop->id)->with('error', 'This Employee Is Already Employed');
        else if (Auth::user()->id == $shop->owner_id) {
            $employee->role_id = 4;
            $employee->save();
            $employment = new Employment();
            $employment->employee_id = $employee->id;
            $employment->shop_id = $shop->id;
            $employment->save();
            return redirect()->route('employment', $shop->id);
        } else
            return back()->with('error', 'Somthing Went Wrong');
    }
    public function fire(Shop $shop, User $user)
    {
        $employee = User::where('email', $user->email)->firstOrFail();
        if ($employee->role_id == 4 & Auth::user()->id == $shop->owner_id) {
            $employee->role_id = 5;
            $employee->save();
            $employment = Employment::where('employee_id', $employee->id)->firstOrFail();
            $employment->delete();
            return redirect()->route('employment', $shop->id);
        } else
            return back();
    }

    public function menu(Shop $shop,)
    {
        $categories = $shop->categories;
        return view('shops.menu', ['shop' => $shop, 'categories' => $categories]);
    }
}
