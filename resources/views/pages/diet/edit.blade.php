@extends('layouts.main')
@section('title', 'Atualiazr Dieta')
@section('content')

<section class="pt-16">

    <form action="{{ route('diet.update', $diet->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="">Nome</label>
            <input type="text" id="name" name="name" placeholder="digite seu nome" value="{{ $diet->name }}">
        </div>
        <button type="submit">Alterar</button>
    </form>
</section>


@endsection