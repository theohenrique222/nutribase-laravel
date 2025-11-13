@extends('layouts.main')
@section('title', 'Criar Dieta')
@section('content')

    <section class="pt-16 min-h-screen bg-neutral-800">
        <div class="text-center mt-10 mb-8">
            <h1 class="text-3xl font-bold text-lime-500">Create products</h1>
            <p class="text-gray-100">Cadastre os produtos que serão incluido nas suas dietas</p>
        </div>
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-2xl p-6 mt-10">
            <form action="{{ route('products.store') }}" method="post" class="space-y-3">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome:</label>
                    <input type="text" name="name" placeholder="Digite o nome do produto" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition" value="{{ $products->name }}"/>
                </div>
                <div>
                    <label for="portion_unit" class="block text-sm font-medium text-gray-700 mb-1">Unidade de medida</label>
                    <select name="portion_unit" id="portion_unit"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                        <option value="g" {{ $products->portion_unit == 'g' ? 'selected' : '' }} >Gramas</option>
                        <option value="ml" {{ $products->portion_unit == 'ml' ? 'selected' : '' }} >Mililitro</option>
                        <option value="un" {{ $products->portion_unit == 'un' ? 'selected' : '' }} >Unidade</option>
                    </select>
                </div>
                    <div>
                        <label for="observation" class="block text-sm font-medium text-gray-700 mb-1">Observação</label>
                        <input type="text" name="observation" placeholder="Digite alguma observação se necessário"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition" value="{{ $products->observation }}">
                    </div>
                    <div class="text-center pt-4">
                        <button type="submit"
                            class="px-6 py-2 bg-lime-500 cursor-pointer text-white font-semibold rounded-md hover:bg-lime-700 transition-all duration-200">
                            Salvar Produto
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection