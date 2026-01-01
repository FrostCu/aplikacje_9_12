<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['category', 'publisher', 'authors'])->latest()->paginate(20);
        return view('admin.books.index', compact('books'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        $authors = Author::all();
        return view('admin.books.edit', compact('book', 'categories', 'publishers', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:20|unique:books,isbn,' . $book->id,
            'description' => 'nullable|string',
            'published_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'total_copies' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'authors' => 'array',
            'authors.*' => 'exists:authors,id',
        ]);

        $book->update($request->only([
            'title', 'isbn', 'description', 'published_year', 'total_copies', 'category_id', 'publisher_id'
        ]));

        if ($request->has('authors')) {
            $book->authors()->sync($request->authors);
        }

        return redirect()->route('admin.books.index')->with('success', 'Książka zaktualizowana pomyślnie.');
    }
}
