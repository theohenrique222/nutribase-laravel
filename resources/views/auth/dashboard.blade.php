@extends('layouts.main')
@section('title', 'Login')
@section('content')

<section class="bg-neutral-900 min-h-screen pt-16">
    <div class="">
        <p class="text-white">Olá {{ auth()->user()->name }}</p>

    </div>
</section>

@endsection
