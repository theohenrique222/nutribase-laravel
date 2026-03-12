<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    title: string;
    diets: any[];
    student: string;
}>();

const groupFoodsByMeal = (foods: any[]) => {
    const meals: Record<number, any[]> = {};
    foods.forEach((food) => {
        const mealNum = food.pivot.meal_number;
        if (!meals[mealNum]) meals[mealNum] = [];
        meals[mealNum].push(food);
    });
    return meals;
};
</script>

<template>
    <Head :title="title" />
    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative flex-1 rounded-xl border">
                <div class="mx-auto max-w-7xl p-6">
                    <h1 class="mb-6 text-2xl font-bold dark:text-white">
                        {{ title }}
                    </h1>
                    <div class="bg-surface-50 dark:bg-surface-950">
                        <div class="bg-surface-0 dark:bg-surface-900 flex flex-col gap-4 rounded-2xl p-6 shadow">
                            <div v-for="diet in diets" :key="diet.id" class="mb-4 rounded border p-4">
                                <div class="text-lg font-bold">{{ diet.objective }}</div>
                                <div>
                                    <p>
                                        Aluno: <span class="font-bold">{{ student.user.name }}</span>
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Calorias: <span class="font-bold">{{ diet.calories }}</span>
                                    </p>
                                </div>

                                <div v-for="(meal, mIndex) in diet.meals" :key="mIndex" class="mt-2 rounded border p-2">
                                    <div class="mb-1 bg-emerald-500 p-1 text-center font-bold text-white">
                                        <h2 class="text-xl">Refeição {{ mIndex + 1 }}</h2>
                                    </div>

                                    <div v-for="(product, pIndex) in meal.products" :key="pIndex" class="flex justify-between p-1">
                                        <div v-for="(foods, mealNumber) in groupFoodsByMeal(diet.foods)" :key="mealNumber">
                                            <div v-for="food in foods" :key="food.id">
                                                <p>
                                                    Alimento: <span class="font-bold">{{ food.name }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <p>
                                                Quantidade: <span class="font-bold">{{ product.quantity }} g</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                Observação: <span class="font-bold">{{ product.observation ?? 'Nenhuma' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        v-if="!diets"
                        class="m-auto w-1/5">
                        <Link :href="route('diet.create')">
                            <Button label="Montar Dieta" class="w-full" severity="success" />
                        </Link>
                    </div>
                    <div
                        v-if="diets"
                        class="m-auto w-1/5">
                        <Link :href="route('diet.edit')">
                            <Button label="Montar Dieta" class="w-full" severity="success" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
