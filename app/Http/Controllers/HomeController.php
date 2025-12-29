<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('client.dashboard');
    }

    /**
     * Show the client dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $loans = $user->loans()->with('book')->latest()->get();
        $reservations = $user->reservations()->with('book')->latest()->get();
        $reviews = $user->reviews()->with('book')->latest()->get();

        return view('dashboard', compact('loans', 'reservations', 'reviews'));
    }
}