@extends('layouts.main')
@section('title', 'Criar Dieta')
@section('content')

    <div id="product-template" class="hidden">
        <div class="product grid grid-cols-3 gap-2 mb-2">
            <select class="product-select border rounded-lg px-2 py-1" required>
                <option value="" disabled selected>Produto</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <input type="text" class="product-qty border rounded-lg px-2 py-1" placeholder="Quantidade" required>
            <input type="text" class="product-obs border rounded-lg px-2 py-1" placeholder="Observação">
            <div>
                <button type="button" class="remove-btn ml-2 cursor-pointer hover:underline">Remover</button>
            </div>
        </div>
    </div>

    <section class="pt-16 min-h-screen bg-neutral-800">
        <div class="text-center mt-10 mb-8">
            <h1 class="text-3xl font-bold text-lime-500">🍎 Montar Refeições</h1>
            <p class="text-gray-100">Acompanhe e gerencie suas dietas cadastradas</p>
        </div>
        <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-lg">
                <form action="{{ route('diet.store') }}" method="POST" id="dietForm">
                    @csrf
                    <div id="dietContainer" class="space-y-6">
                        <div class="meal border rounded-lg p-4 bg-gray-50">
                            <div class="mb-3">
                                <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Aluno:</label>

                                <select name="client_id" id="" class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                                    <option value="{{ $client->id }}">{{ $client->name  }}</option>
                                </select>

                            <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Objetivo:</label>
                            <input type="text" name="name" placeholder="Ex: Hipertrofia" class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition" required>
                            </div>
                            <div class="flex justify-between items-center mb-3">
                                <h2 class="font-semibold text-lg">Café da manhã</h2>
                                <button type="button" class="text-red-500 hover:underline remove-meal hidden">Remover</button>
                            </div>
                        <div id="products" class="space-y-3"></div>
                            <button type="button" id="add-product" class="delete-product text-sm text-neutral-800 mt-2 hover:underline cursor-pointer">
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

        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const container = document.getElementById("products");
            const templateProduct = document.getElementById("product-template");
            const addBtn = document.getElementById("add-product");
            const template = templateProduct.firstElementChild;
            let index = 0;

            function addProductBlock() {
                const clone = template.cloneNode(true);
                clone.querySelector(".product-select").name = `products[${index}][product_id]`;
                clone.querySelector(".product-qty").name    = `products[${index}][quantity]`;
                clone.querySelector(".product-obs").name    = `products[${index}][observation]`;
                clone.querySelector(".remove-btn").addEventListener("click", () => {
                    clone.remove();
                });
                container.appendChild(clone);
                index++;
            }

            addProductBlock();

            addBtn.addEventListener("click", addProductBlock);
        });
    </script>
@endsection
