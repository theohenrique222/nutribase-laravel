@extends('layouts.main')
@section('title', 'Dieta')
@section('content')

    <section class="min-h-screen pt-16 bg-neutral-800">
        <div class="text-center mt-10 mb-8">
            <h1 class="text-3xl font-bold text-lime-500">
                Dieta: {{ $diet->name }}
            </h1>
            <p class="text-gray-100">
                Aluno: {{ $diet->client->name }}
            </p>
        </div>

        <div class="bg-gray-100 shadow-md rounded-xl max-w-4xl mx-auto p-6">

            {{-- Dados do Aluno --}}
            <div class="mb-6 border-b pb-4">
                <h2 class="text-xl font-semibold text-neutral-700 mb-3">Informações do Aluno</h2>

                <div class="grid grid-cols-2 gap-4">
                    <p><strong>Nome:</strong> {{ $diet->client->name }}</p>
                    <p><strong>Idade:</strong> {{ $diet->client->age }}</p>

                    <p><strong>Peso:</strong> {{ $diet->client->weight }} kg</p>
                    <p><strong>Altura:</strong> {{ $diet->client->height }} cm</p>

                    <p><strong>Cintura:</strong> {{ $diet->client->waist }} cm</p>
                    <p><strong>Objetivo:</strong>
                        @switch($diet->client->goal)
                            @case(1) Emagrecimento @break
                            @case(2) Hipertrofia @break
                            @case(3) Condicionamento @break
                            @default Não informado
                        @endswitch
                    </p>
                </div>
            </div>

            {{-- Lista de Alimentos da Dieta --}}
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-neutral-700 mb-3">Alimentos da Dieta</h2>

                <div class="border rounded-xl overflow-hidden">
                    <div class="grid grid-cols-4 bg-lime-500 text-white font-semibold p-3">
                        <p>Nome</p>
                        <p>Quantidade</p>
                        <p>Unidade</p>
                        <p>Observação</p>
                    </div>

                    @forelse ($diet->products as $product)
                        <div class="grid grid-cols-4 p-3 border-b bg-white">
                            <p>{{ $product->name }}</p>
                            <p>{{ $product->pivot->quantity }}</p>
                            <p>{{ $product->portion_unit }}</p>
                            <p>{{ $product->pivot->observation ?? '-' }}</p>
                        </div>
                    @empty
                        <p class="p-4 text-center text-neutral-600">
                            Nenhum alimento cadastrado para esta dieta.
                        </p>
                    @endforelse
                </div>
            </div>

            {{-- Botões --}}
            <div class="flex justify-between mt-6">
                <a href="{{ route('clients.show', $diet->client->id) }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded-md transition">
                    Voltar
                </a>

                <a href="{{ route('diet.edit', $diet->id) }}"
                   class="bg-lime-500 hover:bg-lime-600 text-white font-medium px-4 py-2 rounded-md transition">
                    Editar Dieta
                </a>
            </div>

        </div>
    </section>

@endsection
