@extends('layouts.main')
@section('title', 'Produtos')
@section('content')

    <section class="min-h-screen pt-16 bg-neutral-800">
        <div class="text-center mt-10 mb-8">
            <h1 class="text-3xl font-bold text-lime-500">Produtos Cadastrados</h1>
            <p class="text-gray-50 font-light">Acompanhe e gerencie os produtos utilizados nas suas dietas</p>
        </div>

        <div class="bg-gray-100 min-h-80 backdrop-blur-sm shadow-md rounded-xl overflow-hidden max-w-6xl m-auto">
            <div class="grid grid-cols-4 bg-lime-500 text-neutral-50 font-semibold uppercase text-center p-4 border-b">
                <p>Nome</p>
                <p>Unidade</p>
                <p>Observação</p>
                <p>Ações</p>
            </div>

            @forelse ($products as $product)
                <div class="grid grid-cols-4 text-center items-center border-b border-neutral-300 p-4 bg-white hover:bg-lime-50 transition">
                    <p class="font-medium text-gray-900">{{ $product->name }}</p>
                    <p class="text-gray-700">{{ $product->portion_unit }}</p>
                    <p class="text-gray-700">{{ $product->observation }}</p>

                    <div class="flex justify-center gap-2 mt-2 sm:mt-0">
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="bg-lime-500 hover:bg-lime-600 text-white text-sm font-medium px-3 py-1.5 rounded-md transition">
                            Editar
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-1.5 rounded-md transition">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-600">
                    <p>Você ainda não possui produtos cadastrados.</p>
                </div>
            @endforelse
            <div class="text-center mt-10">
                <a href="{{ route('products.create') }}"
                    class="inline-block mt-4 bg-lime-500 hover:bg-lime-600 text-white font-medium px-4 py-2 rounded-md transition">
                    + Cadastrar Produto
                </a>
            </div>
        </div>
    </section>
@endsection
