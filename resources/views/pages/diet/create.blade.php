@extends('layouts.main')
@section('title', 'Criar Dieta')
@section('content')

    <div id="product-template" class="hidden">
        <div class="product grid grid-cols-3 gap-2 mb-2">
            <select class="product-select bg-white border border-gray-300 rounded-lg px-2 py-1" required>
                <option value="" disabled selected>Produto</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <input type="text" class="product-qty bg-white border border-gray-300 rounded-lg px-2 py-1" placeholder="Quantidade" required>
            <input type="text" class="product-obs bg-white border border-gray-300 rounded-lg px-2 py-1" placeholder="Observação">
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
                <div class="space-y-6">
                    <div id="dietContainer" class="meal-block border border-gray-300 rounded-lg p-4 bg-gray-50">
                        <div class="mb-3">
                            <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Aluno:</label>

                            <select name="client_id" class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                                <option value="{{ $client->id }}">{{ $client->name  }}</option>
                            </select>

                            <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Objetivo:</label>
                            <input type="text" name="name" placeholder="Ex: Hipertrofia" class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition" required>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <input name="meals" class="w-full font-semibold text-lg" value="Café da manhã">
                            <button type="button" class="text-red-500 hover:underline remove-meal hidden">Remover</button>
                        </div>
                        <div class="products space-y-3">

                        </div>
                        <button type="button" class="add-product delete-product text-sm text-neutral-800 mt-2 hover:underline cursor-pointer">
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

            const templateProduct = document.getElementById("product-template").firstElementChild;
            let index = 0;

            function addProduct(targetMeal) {
                const clone = templateProduct.cloneNode(true);

                clone.querySelector(".product-select").name = `products[${index}][product_id]`;
                clone.querySelector(".product-qty").name    = `products[${index}][quantity]`;
                clone.querySelector(".product-obs").name    = `products[${index}][observation]`;

                clone.querySelector(".remove-btn").addEventListener("click", () => clone.remove());

                targetMeal.appendChild(clone);
                index++;
            }

            // Adicionar produto da refeição inicial
            const firstMealProducts = document.querySelector("#dietContainer .products");
            addProduct(firstMealProducts);

            // Delegação para adicionar produto em qualquer refeição
            document.body.addEventListener("click", (e) => {
                if (e.target.classList.contains("add-product")) {
                    const meal = e.target.closest(".meal-block").querySelector(".products");
                    addProduct(meal);
                }
            });

            // Adicionar nova refeição
            const addMealBtn = document.getElementById("addMeal");
            const mealContainer = document.getElementById("dietContainer");

            addMealBtn.addEventListener("click", () => {
                const newMeal = document.createElement("div");
                newMeal.classList.add("pt-5", "meal-block");

                newMeal.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <input name="meals[][name]" class="w-full font-semibold text-lg" value="Nova refeição">
                <button type="button" class="text-red-500 hover:underline remove-meal">Remover</button>
            </div>

            <div class="products space-y-3"></div>

            <button type="button" class="add-product text-sm text-neutral-800 mt-2 hover:underline cursor-pointer">
                + Adicionar produto
            </button>
        `;

                mealContainer.appendChild(newMeal);

                // adiciona 1 produto automaticamente na refeição criada
                const newProductsDiv = newMeal.querySelector(".products");
                addProduct(newProductsDiv);
            });
        });
    </script>


@endsection
