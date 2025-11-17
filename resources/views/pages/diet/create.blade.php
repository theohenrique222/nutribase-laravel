@extends('layouts.main')
@section('title', 'Criar Dieta')
@section('content')



    <section class="pt-16 min-h-screen bg-neutral-800">
        <div class="text-center mt-10 mb-8">
            <h1 class="text-3xl font-bold text-lime-500">🍎 Montar Refeições</h1>
            <p class="text-gray-100">Acompanhe e gerencie suas dietas cadastradas</p>
        </div>
        <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-lg">
            <form action="{{ route('diet.store') }}" method="POST" id="dietForm">
                @csrf

                <div x-data="dietComponent()" class="space-y-6">

                    <!-- Loop das Refeições -->
                    <template x-for="(meal, mealIndex) in meals" :key="mealIndex">
                        <div class="meal-block border border-gray-300 rounded-lg p-4 bg-gray-50">
                            <!-- Aluno e objetivo só aparecem na primeira refeição -->
                            <template x-if="mealIndex === 0">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Aluno:</label>

                                    <select name="client_id"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-lime-500 focus:border-lime-500">
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    </select>

                                    <label class="block text-sm font-medium text-gray-700 mb-1 mt-3">Objetivo:</label>
                                    <input type="text" name="name" placeholder="Ex: Hipertrofia"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-lime-500 focus:border-lime-500" required>
                                </div>
                            </template>

                            <!-- Título da refeição -->
                            <div class="flex justify-between items-center mb-3">
                                <input type="text"
                                       :name="`meals[${mealIndex}][name]`"
                                       class="w-full font-semibold text-lg border-none bg-transparent"
                                       x-model="meal.name">

                                <button type="button"
                                        class="text-red-500 hover:underline"
                                        @click="removeMeal(mealIndex)"
                                        x-show="meals.length > 1">
                                    Remover
                                </button>
                            </div>

                            <!-- Produtos da refeição -->
                            <div class="products space-y-3">

                                <template x-for="(product, productIndex) in meal.products" :key="productIndex">
                                    <div class="product grid grid-cols-3 gap-2 items-center">

                                        <!-- Produto -->
                                        <select
                                            class="product-select bg-white border border-gray-300 rounded-lg px-2 py-1"
                                            :name="`meals[${mealIndex}][products][${productIndex}][product_id]`"
                                            x-model="product.product_id"
                                            required>
                                            <option value="" disabled selected>Produto</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>

                                        <!-- Quantidade -->
                                        <input type="text"
                                               class="product-qty bg-white border border-gray-300 rounded-lg px-2 py-1"
                                               placeholder="Quantidade"
                                               :name="`meals[${mealIndex}][products][${productIndex}][quantity]`"
                                               x-model="product.quantity"
                                               required>

                                        <!-- Observação -->
                                        <div class="flex items-center gap-2">
                                            <input type="text"
                                                   class="product-obs bg-white border border-gray-300 rounded-lg px-2 py-1 w-full"
                                                   placeholder="Observação"
                                                   :name="`meals[${mealIndex}][products][${productIndex}][observation]`"
                                                   x-model="product.observation">

                                            <button type="button"
                                                    class="remove-btn text-red-500 hover:underline cursor-pointer"
                                                    @click="removeProduct(mealIndex, productIndex)">
                                                Remover
                                            </button>
                                        </div>

                                    </div>
                                </template>

                            </div>

                            <!-- Botão adicionar produto -->
                            <button type="button"
                                    class="add-product text-sm text-neutral-800 mt-2 hover:underline cursor-pointer"
                                    @click="addProduct(mealIndex)">
                                + Adicionar produto
                            </button>

                        </div>
                    </template>

                    <!-- Botão adicionar nova refeição -->
                    <div class="text-center mt-6 space-x-3">
                        <button type="button"
                                class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 cursor-pointer"
                                @click="addMeal()">
                            + Adicionar nova refeição
                        </button>

                        <button type="submit"
                                class="bg-lime-500 text-white px-4 py-2 rounded-lg hover:bg-lime-700 cursor-pointer">
                            Salvar refeições
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </section>

    <script>
        function dietComponent() {
            return {
                meals: [
                    {
                        name: "Café da manhã",
                        products: [
                            {
                                product_id: "",
                                quantity: "",
                                observation: ""
                            }
                        ]
                    }
                ],

                addMeal() {
                    this.meals.push({
                        name: "Nova refeição",
                        products: [
                            {
                                product_id: "",
                                quantity: "",
                                observation: ""
                            }
                        ]
                    });
                },

                removeMeal(mealIndex) {
                    this.meals.splice(mealIndex, 1);
                },

                addProduct(mealIndex) {
                    this.meals[mealIndex].products.push({
                        product_id: "",
                        quantity: "",
                        observation: ""
                    });
                },

                removeProduct(mealIndex, productIndex) {
                    this.meals[mealIndex].products.splice(productIndex, 1);
                }
            }
        }
    </script>


    {{--    <script>--}}
{{--        document.addEventListener("DOMContentLoaded", () => {--}}

{{--            const templateProduct = document.getElementById("product-template").firstElementChild;--}}
{{--            let index = 0;--}}

{{--            function addProduct(targetMeal) {--}}
{{--                const clone = templateProduct.cloneNode(true);--}}

{{--                clone.querySelector(".product-select").name = `products[${index}][product_id]`;--}}
{{--                clone.querySelector(".product-qty").name    = `products[${index}][quantity]`;--}}
{{--                clone.querySelector(".product-obs").name    = `products[${index}][observation]`;--}}

{{--                clone.querySelector(".remove-btn").addEventListener("click", () => clone.remove());--}}

{{--                targetMeal.appendChild(clone);--}}
{{--                index++;--}}
{{--            }--}}

{{--            // Adicionar produto da refeição inicial--}}
{{--            const firstMealProducts = document.querySelector("#dietContainer .products");--}}
{{--            addProduct(firstMealProducts);--}}

{{--            // Delegação para adicionar produto em qualquer refeição--}}
{{--            document.body.addEventListener("click", (e) => {--}}
{{--                if (e.target.classList.contains("add-product")) {--}}
{{--                    const meal = e.target.closest(".meal-block").querySelector(".products");--}}
{{--                    addProduct(meal);--}}
{{--                }--}}
{{--            });--}}

{{--            // Adicionar nova refeição--}}
{{--            const addMealBtn = document.getElementById("addMeal");--}}
{{--            const mealContainer = document.getElementById("dietContainer");--}}

{{--            addMealBtn.addEventListener("click", () => {--}}
{{--                const newMeal = document.createElement("div");--}}
{{--                newMeal.classList.add("pt-5", "meal-block");--}}

{{--                newMeal.innerHTML = `--}}
{{--            <div class="flex justify-between items-center mb-3">--}}
{{--                <input name="meals[][name]" class="w-full font-semibold text-lg" value="Nova refeição">--}}
{{--                <button type="button" class="text-red-500 hover:underline remove-meal">Remover</button>--}}
{{--            </div>--}}

{{--            <div class="products space-y-3"></div>--}}

{{--            <button type="button" class="add-product text-sm text-neutral-800 mt-2 hover:underline cursor-pointer">--}}
{{--                + Adicionar produto--}}
{{--            </button>--}}
{{--        `;--}}
{{--                mealContainer.appendChild(newMeal);--}}


{{--                const newProductsDiv = newMeal.querySelector(".products");--}}
{{--                addProduct(newProductsDiv);--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}


@endsection
