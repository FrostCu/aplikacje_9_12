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

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $userId = Auth::id();
        $bookId = $request->book_id;

        $exists = Reservation::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Już zarezerwowałeś tę książkę.');
        }

        $book = \App\Models\Book::find($bookId);
        if ($book->available_copies < 1) {
            return back()->with('error', 'Przepraszamy, nie ma dostępnych egzemplarzy do rezerwacji w tej chwili.');
        }

        Reservation::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'reserved_date' => now()->toDateString(),
        ]);

        return back()->with('success', 'Książka została zarezerwowana pomyślnie!');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->delete();

        return back()->with('success', 'Rezerwacja anulowana.');
    }
}