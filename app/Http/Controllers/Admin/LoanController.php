<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'book'])->latest()->paginate(20);
        return view('admin.loans.index', compact('loans'));
    }

    public function create()
    {
        $users = User::where('role', 'client')->get();
        $books = Book::whereDoesntHave('loans', function ($query) {
            $query->whereNull('returned_date');
        })->get();
        
        return view('admin.loans.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        $isBookLoaned = Loan::where('book_id', $request->book_id)
            ->whereNull('returned_date')
            ->exists();

        if ($isBookLoaned) {
            return back()->withErrors(['book_id' => 'Ta książka jest obecnie wypożyczona.']);
        }

        Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'loan_date' => now(),
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('admin.loans.index')->with('success', 'Wypożyczenie utworzone pomyślnie.');
    }

    public function update(Request $request, Loan $loan)
    {
        if ($request->has('return')) {
            $loan->update([
                'returned_date' => now(),
            ]);
            return back()->with('success', 'Książka oznaczona jako zwrócona.');
        }

        return back();
    }
}
