<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Análise Corporal',
        href: '/personal-datas',
    },
];

defineProps<{
    title: string,
    personalData: Array<{
        tmb: number
        waterIntake: number
    }>

}>()
</script>

<template>

    <Head :title="title" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min bg-neutral-900">
                <div class="p-6 max-w-7xl mx-auto">
                    <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ title }}</h1>
                    <div class="overflow-x-auto bg-white dark:bg-neutral-900 shadow-lg">
                        <!-- <table class="min-w-full table-auto text-sm text-left mb-10">
                            <thead
                                class="dark:bg-neutral-800 bg-neutral-500 text-white border  dark:border-b-neutral-500 border-b-black text-center">
                                <tr>
                                    <th class="p-3">IMC</th>
                                    <th class="p-3">Metabolismo basal</th>
                                    <th class="p-3">Injestão de água</th>
                                    <th class="p-3">Proteinas</th>
                                    <th class="p-3">Carboidratos</th>
                                    <th class="p-3">Gordura</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in personalData" :key="item.id"
                                    class="border-b hover:bg-blue-50 dark:hover:bg-neutral-800 text-center">
                                    <td class="p-3">{{ item.tmb }}</td>
                                    <td class="p-3"></td>
                                    <td class="p-3">{{ item.waterIntake }}</td>
                                </tr>
                            </tbody>
                        </table> -->
                        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

                            <div v-for="item in personalData" :key="item.id"
                                class="bg-neutral-800 relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border text-center p-5">
                                <h2 class="text-2xl font-extrabold p-2">{{ item.tmb.title }}</h2>
                                <h3 class="text-sm font-extralight">{{ item.tmb.subtitle }}</h3>
                                <h3 class="text-2xl font-bold p-2">{{ item.tmb.value }}</h3>
                            </div>

                            <div v-for="item in personalData" :key="item.id"
                                class="bg-neutral-800 relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border text-center p-5">
                                <h2 class="text-2xl font-extrabold p-2">{{ item.waterIntake.title }}</h2>
                                <h3 class="text-sm font-extralight">{{ item.waterIntake.subtitle }}</h3>
                                <h3 class="text-2xl font-bold p-2">{{ item.waterIntake.value }}</h3>
                            </div>

                            <div v-for="item in personalData" :key="item.id"
                                class="bg-neutral-800 relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border text-center p-5">
                                <h2 class="text-2xl font-extrabold p-2">{{ item.imc.title }}</h2>
                                <h3 class="text-sm font-extralight">{{ item.imc.subtitle }}</h3>
                                <h3 class="text-2xl font-bold p-2">{{ item.imc.value }}</h3>
                            </div>

                            <div v-for="item in personalData" :key="item.id"
                                class="bg-neutral-800 relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border text-center p-5">
                                <h2 class="text-2xl font-extrabold p-2">{{ item.proteins.title }}</h2>
                                <h3 class="text-sm font-extralight">{{ item.proteins.subtitle }}</h3>
                                <h3 class="text-2xl font-bold p-2">{{ item.proteins.value }}</h3>
                            </div>

                            <div v-for="item in personalData" :key="item.id"
                                class="bg-neutral-800 relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border text-center p-5">
                                <h2 class="text-2xl font-extrabold p-2">{{ item.carbohydrates.title }}</h2>
                                <h3 class="text-sm font-extralight">{{ item.carbohydrates.subtitle }}</h3>
                                <h3 class="text-2xl font-bold p-2">{{ item.carbohydrates.value }}</h3>
                            </div>

                            <div v-for="item in personalData" :key="item.id"
                                class="bg-neutral-800 relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border text-center p-5">
                                <h2 class="text-2xl font-extrabold p-2">{{ item.fats.title }}</h2>
                                <h3 class="text-sm font-extralight">{{ item.fats.subtitle }}</h3>
                                <h3 class="text-2xl font-bold p-2">{{ item.fats.value }}</h3>
                            </div>

                            <!-- <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                                <PlaceholderPattern />
                            </div>
                            <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                                <PlaceholderPattern />
                            </div> -->
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
