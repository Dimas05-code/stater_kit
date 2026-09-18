{{-- Memanggil komponen x-layout sebagai kerangka utama web --}}
<x-layout :tittle="$tittle">

    {{-- PERHATIAN: Di halaman ini TIDAK ADA @foreach karena kita hanya menerima 
         dan menampilkan SATU data artikel secara utuh. --}}
    {{-- <article class="py-8 max-w-3xl border-b border-gray-300"> --}}

    {{-- JUDUL ARTIKEL: 
             Dicetak dengan huruf besar menggunakan class teks dari Tailwind (text-3xl font-bold) --}}
    {{-- <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $post['tittle'] }}</h2> --}}

    {{-- NAMA PENULIS: 
             Menampilkan pembuat artikel ini. Jika diklik, pengunjung akan diarahkan 
             ke halaman profil penulis yang berisi seluruh daftar artikel milik orang tersebut. --}}
    {{-- <div class="text-base text-gray-500">
            by <a href="/authors/{{ $post->author->username }}"
                class="text-gray-900 hover:underline">{{ $post->author->name }} in </a>
            <a href="/categories/{{ $post->category->slug }}"
                class="text-gray-900
                hover:underline">{{ $post->category->name }}</a>
        </div> --}}

    {{-- ISI ARTIKEL FULL: 
             Menampilkan seluruh isi cerita tanpa menggunakan pemotong teks (Str::limit) 
             sehingga pengunjung bisa membaca sampai habis. --}}
    {{-- <p class="my-4 font-light">{{ $post['isi'] }}</p> --}}

    {{-- TOMBOL KEMBALI: 
             Tombol sederhana untuk memulangkan pengunjung ke halaman utama daftar artikel (/posts) --}}
    {{-- <a href="/posts" class="font-medium text-blue-500 hover:underline">&laquo; Back to all posts</a> --}}


    <!--
Install the "flowbite-typography" NPM package to apply styles and format the article content:

URL: https://flowbite.com/docs/components/typography/
-->

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-7xl ">

            <article
                class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">

                {{-- TOMBOL KEMBALI: 
              Tombol sederhana untuk memulangkan pengunjung ke halaman utama daftar artikel (/posts) --}}
                <a href="/posts" class="font-medium text-xs text-blue-500 hover:underline">&laquo; Back to all posts</a>

                <header class="my-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos">
                            <div>
                                {{-- NAMA PENULIS: 
                                   Menampilkan pembuat artikel ini. Jika diklik, pengunjung akan diarahkan 
                                   ke halaman profil penulis yang berisi seluruh daftar artikel milik orang tersebut. --}}
                                {{-- <a href="/authors/{{ $post->author->username }}" rel="author" --}}
                                <a href="/posts?author={{ $post->author->username }}" rel="author"
                                    class="text-xl font-bold text-gray-900 dark:text-white hover:underline">{{ $post->author->name }}</a>
                                {{-- <p class="text-base text-gray-500 dark:text-gray-400">Graphic Designer, educator & CEO
                                    Flowbite</p> --}}
                                {{-- <a href="/categories/{{ $post->category->slug }} " class="block"> --}}
                                <a href="/posts?category={{ $post->category->slug }}" class="block">
                                    <span
                                        class="{{ $post->category->color }} text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">

                                        {{-- Mengambil kategori berdasarkan nama --}}
                                        {{ $post->category->name }}
                                    </span>
                                </a>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    {{ $post->created_at->diffForHumans() }}</time></p>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        Best practices for successful prototypes</h1>
                </header>
                {{-- <p class="lead">Flowbite is an open-source library of UI components built with the utility-first
                    classes from Tailwind CSS. It also includes interactive elements such as dropdowns, modals,
                    datepickers.</p> --}}
                {{-- <p>Before going digital, you might benefit from scribbling down some ideas in a sketchbook. This way,
                    you can think things through before committing to an actual design project.</p> --}}

                {{-- ISI ARTIKEL FULL: 
             Menampilkan seluruh isi cerita tanpa menggunakan pemotong teks (Str::limit) 
             sehingga pengunjung bisa membaca sampai habis. --}}
                <p class="my-4 font-light">{{ $post['isi'] }}</p>
            </article>
        </div>
    </main>

</x-layout>
