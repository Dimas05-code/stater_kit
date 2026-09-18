{{-- Memanggil komponen x-layout sebagai kerangka utama web dan mengirimkan variabel $tittle --}}
<x-layout :tittle="$tittle">

    {{-- MEMULAI PERULANGAN: 
         Mengambil bungkusan data '$posts' dari web.php, lalu membukanya satu per satu 
         dan memberinya nama panggilan '$post' untuk setiap putarannya. --}}
    {{-- @foreach ($posts as $post)
        <article class="py-8 max-w-3xl border-b border-gray-300"> --}}

    {{-- JUDUL ARTIKEL: 
                 Dibuat menjadi link (tautan) yang mengarah ke '/posts/judul-slug-artikel'. 
                 Data diambil menggunakan $post['tittle'] --}}
    {{-- <a href="/posts/{{ $post['slug'] }}" class="hover:underline">
                <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $post['tittle'] }}</h2>
            </a> --}}

    {{-- DATA PENULIS (ELOQUENT RELATIONSHIP): 
                 '$post->author->name' artinya: "Hai Artikel ($post), tolong panggilkan Penulismu (author), 
                 lalu ambilkan Namanya (name)". Ini terjadi berkat relasi yang dibuat di file Model. --}}
    {{-- <div class="text-base text-gray-500">
                by <a href="/authors/{{ $post->author->username }}"
                    class="text-gray-900 hover:underline">{{ $post->author->name }} in </a>
                <a href="/categories/{{ $post->category->slug }}"
                    class="text-gray-900
                hover:underline">{{ $post->category->name }}</a>
            </div> --}}

    {{-- CUPLIKAN ISI ARTIKEL: 
                 Fungsi 'Str::limit' digunakan untuk memotong teks panjang. 
                 Angka 100 berarti kita hanya menampilkan 100 karakter pertama saja sebagai cuplikan (teaser). --}}
    {{-- <p class="my-4 font-light">{{ Str::limit($post['isi'], 100) }}</p> --}}

    {{-- TOMBOL BACA SELENGKAPNYA: 
                 Membawa pengunjung ke halaman detail artikel berdasarkan slug-nya. --}}
    {{-- <a href="/posts/{{ $post['slug'] }}" class="font-medium text-blue-500 hover:underline">Read more &raquo;</a> --}}

    {{-- </article> --}}
    {{-- MENGAKHIRI PERULANGAN --}}
    {{-- @endforeach --}}

    <div class="py-4 px-4 mx-auto max-w-7xl  lg:px-6">

        {{-- KOLOM PENCARIAN --}}
        <form class="mb-8 max-w-md mx-auto">

            {{-- kondisi pencarian berdasarkan categori --}}

            @if (request('category'))
                <input type="hidden" name='category' value="{{ request('category') }}">
            @endif

            <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 inset-s-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search"
                    class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
                    placeholder="Search post tittle..." required autofocus autocomplete="off" name="search" />
                <button type="button"
                    class="absolute inset-e-1.5 bottom-1.5 text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 focus:outline-none">Search</button>
            </div>
        </form>

        {{-- Paginasi --}}
        {{ $posts->links() }}

        {{-- <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
            <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our
                Blog</h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test
                    assumptions and connect with the needs of your audience early and often.</p>
                </div> --}}
        <div class=" my-8 grid gap-8 lg:grid-cols-3 md:grid-cols-2">

            {{-- MEMULAI PERULANGAN: 
                Mengambil bungkusan data '$posts' dari web.php, lalu membukanya satu per satu 
                dan memberinya nama panggilan '$post' untuk setiap putarannya. --}}

            {{-- @foreach ($posts as $post) --}}
            @forelse ($posts as $post)
                <article
                    class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-5 text-gray-500">

                        {{-- Mengarah ke slu ketegory --}}
                        {{-- <a href="/categories/{{ $post->category->slug }}"> --}}

                        {{-- Di ubah karena menyesuaikan pencarian --}}
                        <a href="/posts?category={{ $post->category->slug }}">
                            <span
                                class="{{ $post->category->color }} text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">

                                {{-- <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                </path>
                            </svg>
                            Tutorial --}}
                                {{-- Mengambil kategori berdasarkan nama --}}
                                {{ $post->category->name }}
                            </span>
                        </a>
                        {{-- diffForHumans ==> //output = xx years ago --}}
                        <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    </div>

                    {{-- JUDUL ARTIKEL: 
                        Dibuat menjadi link (tautan) yang mengarah ke '/posts/judul-slug-artikel'. 
                        Data diambil menggunakan $post['tittle'] --}}
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a
                            href="/posts/{{ $post['slug'] }}  "> {{ $post->tittle }}
                    </h2>

                    {{-- CUPLIKAN ISI ARTIKEL: 
                        Fungsi 'Str::limit' digunakan untuk memotong teks panjang. 
                        Angka 100 berarti kita hanya menampilkan 100 karakter pertama saja sebagai cuplikan (teaser). --}}
                    <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ Str::limit($post->isi, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <img class="w-7 h-7 rounded-full"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                alt="Jese Leos avatar" />
                            <a href="/posts?author={{ $post->author->username }}">
                                <span class="font-medium text-sm dark:text-white hover:underline">

                                    {{-- Jese Leos --}}
                                    {{-- DATA PENULIS (ELOQUENT RELATIONSHIP): 
                                    '$post->author->name' artinya: "Hai Artikel ($post), tolong panggilkan Penulismu (author), 
                                     lalu ambilkan Namanya (name)". Ini terjadi berkat relasi yang dibuat di file Model. --}}
                                    {{ $post->author->name }}
                                </span>
                            </a>
                        </div>

                        {{-- TOMBOL BACA SELENGKAPNYA: 
                            Membawa pengunjung ke halaman detail artikel berdasarkan slug-nya. --}}
                        <a href="/posts/{{ $post['slug'] }}"
                            class="inline-flex items-center font-medium text-sm text-primary-600 dark:text-primary-500 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </article>
                {{-- @endforeach --}}

            @empty
                <div>
                    <p class="font-semibold text-xl my-1">Article not found</p>
                    <a href="/posts" class="block text-blue-500 hover:underline"> &laquo; Back to all posts</a>
                </div>
            @endforelse
        </div>
    </div>

</x-layout>
