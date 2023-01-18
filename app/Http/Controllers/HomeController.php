<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $shops = Shop::all();
        } elseif (Gate::allows('isOwner')) {
            $shops = Auth::user()->shops;
            if ($shops->count() == 1)
                return redirect()->route('shops.edit', $shops->first()->id);
        } elseif (Gate::allows('isEmployee')) {
            $employedAtShop = Auth::user()->employment->shop;
        }
        return view('home', [
            'shops' => $shops ?? null,
            'employedAtShop' => $employedAtShop ?? null
        ]);
    }

    public function usersManagment()
    {
        return view('admin.usersManagment');
    }
    public function findUser(Request $request)
    {
        $owner = User::where('email', $request->email)->first() ?? null;
        if ($owner === null)
            return redirect()->route('usersManagment')->with('error', 'User Not Found');
        else
            return redirect()->route('shops.create')->with('ownerId', $owner->id);
    }
}
