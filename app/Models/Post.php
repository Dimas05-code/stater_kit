<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    // public static functioccln all()
    // {
    //     return [[
    //         'id' => 1,
    //         'slug' => 'article-1',
    //         'tittle' => 'Article 1',
    //         'author' => 'Dimas Wahyu Nugroho',
    //         'isi' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam quaerat    consectetur alias porro deserunt recusandae error eaque saepe ipsum sapiente dignissimos ut ex quis dolores officia vel maxime, facere reprehenderit.'
    //     ], [
    //         'id' => 2,
    //         'slug' => 'article-2',
    //         'tittle' => 'Artikel 2',
    //         'author' => 'Muhammad Adit',
    //         'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut eaque expedita enim in
    //         magnam natus nam repellendus ab laboriosam amet omnis, corrupti consequatur repudiandae ullam consequuntur
    //         provident temporibus esse assumenda.'
    //     ]];
    // }

    // method pencarian data
    // public static function find($slug)
    // {
    // return Arr::first(static::all(), function ($post) use ($slug) {
    //     return $post['slug'] == $slug;
    // });

    // menggunakan arrow function
    //     return Arr::first(static::all(), fn($post) => $post['slug'] == $slug) ?? abort(404);
    // }

    // jika membuat factory otomatis harus menambhakan ini
    use HasFactory;

    // $fillable ==> yang bisa di isi secara massal
    protected $fillable = ['tittle', 'slug', 'author_id', 'isi'];

    // $guard ==> yang tidak bisa di isi secara massal (lainnya bisa)
    // protected $guard = ['id']

    // Eager Loading By default
    protected $with = ['author', 'category'];

    // mematikan kewajiban mengisi fillable di semua model
    // Model::unguard() ==> tapi sebagai ganti nya harus memvalidasi request yang masuk

    // One to one/invers(kebalikan) (BelongsTo) ==> Satu post dimiliki satu user
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // satu post memiliki satu kategory
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Pencarian 
    #[Scope]
    protected function filter(Builder $query, array $filters): void
    {
        // Pencarian UMUM
        // null colesing operator penggai ternary operator (jalankan yang sebelah kiri, jika tidak ada nilainya jalankan yang sebelah kanan)
        $query->when($filters['search'] ??  false, function ($query, $search) {
            return $query->where('tittle', 'like', '%' . $search . '%');
        });

        // Pencarian berdasarkan Category
        $query->when($filters['category'] ??  false, function ($query, $category) {
            return $query->whereHas(
                'category',
                fn(Builder $query) => $query->where('slug', $category)
            );
        });

        // Pencarian berdasarkan Author
        $query->when($filters['author'] ??  false, function ($query, $author) {
            return $query->whereHas(
                'author',
                fn(Builder $query) => $query->where('username', $author)
            );
        });
    }
}
