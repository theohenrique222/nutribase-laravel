@extends('layouts.main')
@section('title', 'Criar Dieta')
@section('content')

    <section class="pt-16 min-h-screen bg-neutral-800">
        <div class="text-center mt-10 mb-8">
            <h1 class="text-3xl font-bold text-lime-500">🍎 Montar Refeições</h1>
            <p class="text-gray-100">Acompanhe e gerencie suas dietas cadastradas</p>
        </div>
        <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-lg">
            @if ($clients->isEmpty())
                <div class="mb-3 text-center font-light">
                    <h1>Você não tem alunos cadastrado</h1>
                    <a href="{{ route('clients.create') }}" class="underline text-blue-500">Clique aqui</a><span> para cadastrar
                        seus alunos</span>
                </div>
            @else
                <form action="{{ route('diet.store') }}" method="POST" id="mealsForm">
                    @csrf
                    <div id="mealsContainer" class="space-y-6">
                        <div class="meal border rounded-lg p-4 bg-gray-50">
                            <div class="mb-3">
                                <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Aluno:</label>
                                <select name="client_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                                
                                <option value="">Selecione o aluno</option>
                                
                                @forelse ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @empty
                                <option value="">Você não possui alunos cadastrados</option>
                                @endforelse
                            </select>
                            <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Objetivo:</label>
                            <input type="text" name="name" placeholder="Ex: Hipertrofia" class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                            </div>
                            <div class="flex justify-between items-center mb-3">
                                <h2 class="font-semibold text-lg">Café da manhã</h2>
                                <button type="button" class="text-red-500 hover:underline remove-meal hidden">Remover</button>
                            </div>

                            <div class="products space-y-3">
                                <div class="product grid grid-cols-3 gap-2">
                                    <select name="products[0][product_id]" id=""
                                        class="border rounded-lg px-2 py-1 focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                                        <option value="">Produto</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="products[0][quantity]" placeholder="Quantidade"
                                        class="border rounded-lg px-2 py-1 focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                                    <input type="text" name="products[0][observation]" placeholder="Observação"
                                        class="border rounded-lg px-2 py-1 focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                                </div>
                            </div>

                            <button type="button" class="add-product text-sm text-neutral-800 mt-2 hover:underline">
                                + Adicionar produto
                            </button>
                        </div>
                    </div>

                    <div class="text-center mt-6 space-x-3">
                        <button type="button" id="addMeal"
                            class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-lime-700">
                            + Adicionar nova refeição
                        </button>

                        <button type="submit" class="bg-lime-500 text-white px-4 py-2 rounded-lg hover:bg-lime-700">
                            Salvar refeições
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </section>


@endsection