<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    title: string;
    diets: any[];
    student: string;
    foods: any[];
}>();
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

                    <div v-if="diets.length > 0">
                        <div v-for="diet in diets" :key="diet.id" class="mb-4 rounded border p-4 text-lg">
                            <p>
                                Objetivo: <span class="font-bold">{{ diet.objective }}</span>
                            </p>

                            <p>
                                Atualizado em:
                                <span class="font-bold">
                                    {{ new Date(diet.updated_at).toLocaleDateString('pt-BR') }}
                                </span>
                            </p>

                            <p>
                                Total de calorias: <span class="font-bold">{{ diet.calories }}</span>
                            </p>

                            <!-- refeições -->
                            <div v-for="(meal, mIndex) in diet.meals" :key="mIndex" class="mt-2 rounded border p-2">
                                <div class="mb-1 bg-emerald-500 p-1 text-center font-bold text-white">
                                    <h2 class="text-2xl">Refeição {{ mIndex + 1 }}</h2>
                                </div>

                                <!-- produtos -->
                                <div v-for="(product, pIndex) in meal.products" :key="pIndex" class="flex justify-between p-1 px-5">
                                    <div class="w-full">
                                        <p>
                                            Alimento:
                                            <span class="font-bold">
                                                {{ foods?.find((f) => f.id == product.food)?.name ?? '—' }}
                                            </span>
                                        </p>
                                    </div>

                                    <div class="w-full text-center">
                                        <p>
                                            Quantidade:
                                            <span class="font-bold"> {{ product.quantity }} g </span>
                                        </p>
                                    </div>

                                    <div class="w-full text-end">
                                        <p>
                                            Observação:
                                            <span class="font-bold">
                                                {{ product.observation ?? 'Nenhuma' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else>
                        <h3 class="p-10 text-center">Nenhum protocolo alimentar foi cadastrado</h3>
                    </div>

                    <div v-if="!diets" class="m-auto w-1/5">
                        <Link :href="route('diet.create')">
                            <Button label="Montar Dieta" class="w-full" severity="success" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
