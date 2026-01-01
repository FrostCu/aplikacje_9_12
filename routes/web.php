<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $books = Book::with(['authors', 'category'])->latest()->take(6)->get();
    return view('index', compact('books'));
});

Auth::routes(['reset' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('client.dashboard');
    Route::resource('loans', LoanController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('reviews', ReviewController::class);
});

Route::middleware(['auth', 'role:employee,admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('books', AdminBookController::class)->only(['index', 'edit', 'update']);
    Route::resource('loans', AdminLoanController::class)->only(['index', 'create', 'store', 'update']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
});
