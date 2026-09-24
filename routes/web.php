<?php

use App\Models\Post;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostDashboardController;
// 1. Halaman Home
Route::get('/', function () {
    return view('home', ['tittle' => 'home page']);
});

// 2. Halaman Contact
Route::get('/contact', function () {
    return view('contact', ['tittle' => 'contact page']);
});

// 3. Halam Semua Daftar Posts
Route::get('/posts', function () {
    // latest() ==> untuk memanggil data dari yang terbaru
    // $posts = Post::where('author_id', 1)->get();

    $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(8)->withQueryString();

    return view('posts', ['tittle' => 'blog pagee', 'posts' => $posts]);
});

// Route::get('/posts', function () {
//     // latest() ==> untuk memanggil data dari yang terbaru
//     // EAGER LOADER
//     $posts = Post::with(['author', 'category'])->latest()->get();
//     return view('posts', ['tittle' => 'blog pagee', 'posts' => $posts]);
// });

// 4. Halaman Daftar Artikel Berdasarkan Penulis
// Route::get('/authors/{user:username}', function (User $user) {
//     return view('posts', ['tittle' => 'Ada ' . count($user->posts) . ' article by ' . $user->name, 'posts' => $user->posts]);
// });

// Lazy Eager Loading
// Route::get('/authors/{user:username}', function (User $user) {
//     $posts = $user->posts->load('category');
//     return view('posts', ['tittle' => 'Ada ' . count($posts) . ' article by ' . $user->name, 'posts' => $posts]);
// });


// 5. Halaman Daftar Artikel Berdasarkan Category
// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('posts', ['tittle' => 'Category by ' . $category->name, 'posts' => $category->posts]);
// });

// Route::get('/categories/{category:slug}', function (Category $category) {
//     // Lazy Eager Loading
//     $posts = $category->posts->load('author');
//     return view('posts', ['tittle' => 'Category by ' . $category->name, 'posts' => $posts]);
// });

// 6. Halaman Detail Satu Artikel ( Rute diubah menjadi /posts{slug} agar rapi)
// teknik route wildcard => menangkap  nilai dan di masukkean ke variabel
Route::get('/posts/{post:slug}', function (Post $post) //==> sudah menggunakan route mode binding
{

    // dd($id); ==> untuk melihat data arraydd

    // $post = Post::find($slug);

    // jika id tidak ditemukan
    // if (!$post) abort(404);

    // dd($post);
    return view('post', ['tittle' => 'singular post', 'post' => $post]);
});

// 7. Halaman About
Route::get('/about', function () {
    return view('about', ['tittle' => 'about page']);
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [PostDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/create', [PostDashboardController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.create');
Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard.show');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
