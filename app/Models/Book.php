<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $isbn
 * @property int $total_copies
 * @property int $published_year
 * @property int $category_id
 * @property int $publisher_id
 * @property-read \Illuminate\Support\Collection|\App\Models\Author[] $authors
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Publisher $publisher
 */
class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'isbn',
        'total_copies',
        'published_year',
        'category_id',
        'publisher_id',
    ];

    public function getAvailableCopiesAttribute()
    {
        $activeLoans = $this->loans()->whereNull('returned_date')->count();
        $activeReservations = $this->reservations()->count();
        
        return max(0, $this->total_copies - $activeLoans - $activeReservations);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
