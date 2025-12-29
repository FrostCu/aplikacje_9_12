<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'books_count' => Book::count(),
            'users_count' => User::count(),
            'active_loans' => Loan::whereNull('return_date')->count(),
            'pending_reservations' => Reservation::count(),
        ];

        $recent_loans = Loan::with(['user', 'book'])->latest()->take(5)->get();
        $recent_reservations = Reservation::with(['user', 'book'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_loans', 'recent_reservations'));
    }
}