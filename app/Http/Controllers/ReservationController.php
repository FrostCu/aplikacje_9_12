<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $userId = Auth::id();
        $bookId = $request->book_id;

        // Check if already reserved
        $exists = Reservation::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already reserved this book.');
        }

        Reservation::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'reserved_date' => now()->toDateString(),
        ]);

        return back()->with('success', 'Book reserved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->delete();

        return back()->with('success', 'Reservation cancelled.');
    }
}