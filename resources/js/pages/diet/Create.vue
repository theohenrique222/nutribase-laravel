<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
// import route from 'ziggy-js'

defineProps<{
    title: string;
    foods?: any[];
}>();

const meals = ref([
    {
        products: [{ quantity: '', product: '', observation: '' }],
    },
]);

const addMeal = () => {
    meals.value.push({
        products: [{ quantity: '', product: '', observation: '' }],
    });
};

const addProduct = (mealIndex: number) => {
    meals.value[mealIndex].products.push({ quantity: '', product: '', observation: '' });
};

const removeProduct = (mealIndex: number, productIndex: number) => {
    meals.value[mealIndex].products.splice(productIndex, 1);
};

const submitForm = () => {
    router.post(route('diet.store'), { meals: meals.value });
};
</script>

<template>
    <Head :title="title" />
    <AppLayout>
        <div class="mx-auto max-w-7xl p-6">
            <h1 class="mb-6 text-2xl font-bold dark:text-white">{{ title }}</h1>

            <form class="space-y-4" @submit.prevent="submitForm">
                <div v-for="(meal, mealIndex) in meals" :key="mealIndex" class="rounded-2xl p-6 shadow-md">
                    <h3 class="mb-4 text-xl font-bold">Refeição {{ mealIndex + 1 }}</h3>

                    <div v-for="(product, productIndex) in meal.products" :key="productIndex" class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-4">
                        <div>
                            <label class="mb-1 block text-sm">Quantidade</label>
                            <input
                                type="number"
                                name="quantity"
                                v-model="product.quantity"
                                class="w-full rounded-lg border p-2 focus:ring-2 focus:ring-lime-500 focus:outline-none"
                                placeholder="Ex: 3 fatias / 300 gramas"
                            />
                        </div>
                        <div>
                            <label class="mb-1 block text-sm">Produto</label>
                            <input
                                type="text"
                                name="meals"
                                v-model="product.product"
                                class="w-full rounded-lg p-2 focus:ring-2 focus:ring-lime-500 focus:outline-none"
                                placeholder="Ex: Pão francês"
                            />
                        </div>
                        <div>
                            <label class="mb-1 block text-sm">Observação</label>
                            <input
                                type="text"
                                v-model="product.observation"
                                class="w-full rounded-lg border p-2 focus:ring-2 focus:ring-lime-500 focus:outline-none"
                                placeholder="Ex: Sem o miolo"
                            />
                        </div>
                        <div class="flex flex-col items-center justify-center pt-2">
                            <button
                                v-if="productIndex === meal.products.length - 1"
                                type="button"
                                @click="addProduct(mealIndex)"
                                class="h-9 w-9 cursor-pointer rounded-full bg-lime-500 text-2xl font-bold text-white transition hover:opacity-80"
                            >
                                +
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="removeProduct(mealIndex, productIndex)"
                                class="h-9 w-9 cursor-pointer rounded-full bg-red-500 text-2xl font-bold text-white transition hover:opacity-80"
                            >
                                ×
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-1/2 m-auto">

                    <button
                        type="button"
                        @click="addMeal"
                        class="w-full cursor-pointer rounded-xl bg-lime-500 px-4 py-2 font-semibold text-white transition hover:opacity-90"
                    >
                        + Adicionar Refeição
                    </button>
                    <div class="mt-5">
                        <button
                            type="submit"
                            class="w-full cursor-pointer rounded-xl bg-cyan-500 px-4 py-2 font-semibold text-white transition hover:opacity-90"
                        >
                            Criar Dieta
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
