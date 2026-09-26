<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::latest()->where('author_id', Auth::user()->id);

        if (request('keywoard')) {
            $posts->where('tittle', 'like', '%' . request('keywoard') . '%');

            // if ($posts->count() == 0) {
            //     return redirect()->route('dashboard');
            // }
        }
        return view('dashboard.index', ['posts' => $posts->paginate(3)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->tittle);

        // validation
        $validated = $request->validate([
            'tittle' => ['required', 'unique:posts', 'min:5', 'max:50'],
            'category_id' => ['required'],
            'body' => ['required'],
        ]);

        // Custom validation
        // Validator::make($request->all(), [
        //     'tittle' => ['required', 'unique:posts', 'min:5', 'max:50'],
        //     'category_id' => ['required'],
        //     'body' => ['required'],
        // ], [
        //     'tittle.required' => 'field :attribute harus disi',
        //     'category_id.required' => 'pilih salah satu :attribute',
        //     'body.required' => 'body harus diisi',
        //     'tittle.unique' => 'ganti yang lain',
        //     'tittle.min' => 'minimal 3 kata',
        //     'tittle.max' => 'kebanyakan'
        // ], [
        //     'tittle' => 'judul',
        //     'category_id' => 'categori'
        // ])->validate();


        Post::create([
            'tittle' => $request->tittle,
            'author_id' => Auth::user()->id,
            'slug' => Str::slug($request->tittle),
            'category_id' => $request->category_id,
            'isi' => $request->body,
        ]);

        return redirect('/dashboard')->with(['succes' => 'Your post berhasil']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('dashboard.show', ['post' => $post]);
        // dd($post->all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
