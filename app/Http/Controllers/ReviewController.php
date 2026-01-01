<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5',
        ], [
            'book_id.required' => 'Identyfikator książki jest wymagany.',
            'book_id.exists' => 'Wybrana książka nie istnieje.',
            'rating.required' => 'Ocena jest wymagana.',
            'rating.integer' => 'Ocena musi być liczbą całkowitą.',
            'rating.min' => 'Ocena musi wynosić co najmniej 1.',
            'rating.max' => 'Ocena nie może być większa niż 5.',
            'comment.required' => 'Komentarz jest wymagany.',
            'comment.string' => 'Komentarz musi być ciągiem znaków.',
            'comment.min' => 'Komentarz musi mieć co najmniej 5 znaków.',
        ]);

        $userId = Auth::id();
        $bookId = $request->book_id;

        $exists = Review::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Już oceniłeś tę książkę.');
        }

        Review::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Opinia została dodana pomyślnie!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Opinia została usunięta.');
    }
}