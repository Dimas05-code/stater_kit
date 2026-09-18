{{-- @props() ==> mendeklarasikan variable data yang diterima oleh komponen --}}
@props(['href', 'current' => false, 'ariaCurrent' => false])

@php
    // $classes = $current ? 'bg-yellow-950.50 text-white' : 'text-grey-300 hover:bg-white/5 hover:text-red';

    if ($current) {
        $classes = 'bg-yellow-950/50 text-white';
        $ariaCurrent = 'page';
    } else {
        $classes = 'text-grey-300 hover:bg-white/5 hover:text-white';
    }
@endphp

<!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
<a href="{{ $href }}" {{-- $attributes ==> menampung semuae atribut html yang tidak terdaftar sebagai props --}} {{-- merge() ==> method digunakan untuk menggabungkan atribut bawaan komponen dengan tribut tambahan dari luar --}}
    {{ $attributes->merge(['class' => 'rounded-md px-3 py-2 text-sm font-medium ' . $classes, 'aria-current' => $ariaCurrent]) }}>{{ $slot }}
    <!--  $slot untuk menampung konten atau teks yang disisipkan didalam tag pembuka dan penutup -->
</a>
