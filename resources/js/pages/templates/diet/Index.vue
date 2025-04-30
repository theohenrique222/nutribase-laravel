<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dieta',
        href: '/diet-plan',
    },
];

defineProps<{
    title: string,
    calculations: Array
}>()
</script>

<template>

    <Head :title="title" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="bg-neutral-900 relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
            <div class="p-6 max-w-7xl mx-auto">
                <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ title }}</h1>
                <div class="overflow-x-auto bg-white dark:bg-neutral-900 shadow-lg">
                    <div class="bg-neutral-700 w-full max-w-5xl mx-auto min-h-screen rounded-2xl shadow-lg p-8">
                        <form>
                            <h2 class="text-white text-2xl font-semibold mb-6 text-center">
                                Selecione os alimentos que deseja incluir na sua dieta
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 bg-neutral-800 p-5 rounded-xl text-center mb-2">
                                <div class="">
                                    <h3 class="text-lime-400 text-xl font-bold mb-4">Selecione seu objetivo</h3>
                                    <select name="" id="" class="bg-neutral-700 p-2 rounded-md w-3/4">
                                        <option value="">Hipertrofia</option>
                                        <option value="">Perder gordura</option>
                                        <option value="">Ganho de massa</option>
                                    </select>
                                </div>
                                <div>
                                    <h3 class="text-lime-400 text-xl font-bold mb-4">Selecione seu nível de atividade</h3>
                                    <select name="" id="" class="bg-neutral-700 p-2 rounded-md w-3/4">
                                        <option value="">Ativo</option>
                                        <option value="">Moderado</option>
                                        <option value="">Sedentário</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow">
                                    <h3 class="text-lime-400 text-xl font-bold mb-4">Proteínas</h3>
                                    <div class="space-y-2 text-white">
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Carne
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Frango
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Peixe
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Ovo
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Queijo
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Whey protein
                                        </label>
                                    </div>
                                </div>

                                <div class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow">
                                    <h3 class="text-lime-400 text-xl font-bold mb-4">Carboidratos</h3>
                                    <div class="space-y-2 text-white">
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Arroz
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Macarrão
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Feijão
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Cuscuz
                                        </label>
                                    </div>
                                </div>

                                <div class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow">
                                    <h3 class="text-lime-400 text-xl font-bold mb-4">Saladas</h3>
                                    <div class="space-y-2 text-white">
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Alface
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Tomate
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Cenoura
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Cebola
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Repolho
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Couve
                                        </label>
                                    </div>
                                </div>

                                <div class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow">
                                    <h3 class="text-lime-400 text-xl font-bold mb-4">Gorduras</h3>
                                    <div class="space-y-2 text-white">
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Azeite
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Castanha
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" class="accent-lime-500"> Amendoim
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 text-center">
                                <button type="submit"
                                    class="bg-lime-500 hover:opacity-80 cursor-pointer text-white font-semibold px-8 py-3 rounded-md transition duration-200">
                                    Salvar Preferências
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>