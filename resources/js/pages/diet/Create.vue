<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

defineProps<{
    title: string;
    foods: any[];
    students: any[];
}>();

const header = ref({
    objective: '',
    student: '',
    calories: '',
});

const meals = ref([
    {
        products: [{ quantity: '', food: '', observation: '' }],
    },
]);

const addMeal = () => {
    meals.value.push({
        products: [{ quantity: '', food: '', observation: '' }],
    });
};

const addProduct = (mealIndex: number) => {
    meals.value[mealIndex].products.push({ quantity: '', food: '', observation: '' });
};

const removeProduct = (mealIndex: number, productIndex: number) => {
    meals.value[mealIndex].products.splice(productIndex, 1);
};

const submitForm = () => {
    router.post(route('diet.store'), {
        student_id: header.value.student,
        objective: header.value.objective,
        calories: header.value.calories,
        meals: meals.value,
    });
};
</script>

<template>
    <Head :title="title" />
    <AppLayout>
        <div class="mx-auto max-w-7xl p-6">
            <h1 class="mb-6 text-2xl font-bold">{{ title }}</h1>
            <form class="space-y-4" @submit.prevent="submitForm">
                <div class="flex flex-col gap-2 p-6">
                    <label class="mb-1 block text-sm">Aluno:</label>
                    <select v-model="header.student" class="w-full rounded-lg border p-2 focus:ring-2 focus:ring-lime-500 focus:outline-none">
                        <option value="">Selecione um aluno</option>
                        <option v-for="student in students" :key="student.id" :value="student.id">
                            {{ student.user.name }}
                        </option>
                    </select>

                    <label class="mb-1 block text-sm">Objetivo da dieta</label>
                    <input
                        type="text"
                        v-model="header.objective"
                        name="objective"
                        class="w-full rounded-lg border p-2 focus:ring-2 focus:ring-lime-500 focus:outline-none"
                        placeholder="Ex: Dieta de emagrecimento"
                    />
                    <label class="mb-1 block text-sm">Calorias Totais</label>
                    <input
                        type="number"
                        v-model="header.calories"
                        name="calories"
                        class="w-full rounded-lg border p-2 focus:ring-2 focus:ring-lime-500 focus:outline-none"
                        placeholder="Ex: 2.400 Kcal"
                    />
                </div>
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
                            <select
                                v-model="product.food"
                                name="product"
                                class="w-full rounded-lg border p-2 focus:ring-2 focus:ring-lime-500 focus:outline-none"
                            >
                                <option value="">Selecione o produto</option>
                                <option v-for="food in foods" :key="food.id" :value="food.id">
                                    {{ food.name }}
                                </option>
                            </select>
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
                                :key="mealIndex + '-' + productIndex"
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

                <div class="m-auto w-1/2">
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
