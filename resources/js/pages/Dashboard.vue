<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    title: string;
    students: string;
    diets: any[];
    measurements: any[];
    user: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Painel de controle',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Painel de Controle" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="bg-surface-0 dark:bg-surface-950 px-6 py-20 md:px-12 lg:px-20">
            <div class="text-surface-700 dark:text-surface-100 flex flex-col items-center gap-4 text-center">
                <div class="text-primary text-lg leading-tight font-bold">NUTRIBASE</div>
                <div class="text-surface-900 dark:text-surface-0 text-4xl leading-tight font-bold">👋 Bem-vindo de volta, {{ user.name }}</div>
                <div class="text-surface-700 dark:text-surface-100 text-xl leading-normal">
                    Gerencie dietas, acompanhe alunos e acompanhe a evolução nutricional de forma simples.
                </div>

            </div>
        </div>

        <div class="bg-surface-50 dark:bg-surface-950 px-6 py-8 md:px-12 lg:px-20">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="bg-surface-0 dark:bg-surface-900 rounded-2xl p-5 shadow-sm">
                    <div class="flex justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <span class="text-surface-700 dark:text-surface-300 leading-tight font-normal"> Alunos </span>
                            <div class="text-surface-900 dark:text-surface-0 text-2xl! leading-tight! font-semibold">
                                {{ students ?? '0' }}
                            </div>
                        </div>
                        <Link :href="route('students.index')">
                            <div class="bg-success flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-500">
                                <i class="pi pi-users text-surface-0 dark:text-surface-900 text-xl! leading-none! text-white" />
                            </div>
                        </Link>
                    </div>
                    <div class="mt-4">
                        <span class="text-surface-500 dark:text-surface-300 leading-tight"> Total de alunos </span>
                    </div>
                </div>

                <div class="bg-surface-0 dark:bg-surface-900 rounded-2xl p-5 shadow-sm">
                    <div class="flex justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <span class="text-surface-700 dark:text-surface-300 leading-tight font-normal">Dietas</span>

                            <div>
                                <p
                                    class="text-surface-900 dark:text-surface-0 text-2xl! leading-tight! font-semibold"
                                >
                                    {{ diets }}
                                </p>
                            </div>

                        </div>

                        <Link :href="route('diet.index')">
                            <div class="bg-success flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-500">
                                <i class="pi pi-clipboard text-surface-0 dark:text-surface-900 text-xl! leading-none! text-white" />
                            </div>
                        </Link>
                    </div>
                    <div class="mt-4">
                        <span class="text-surface-500 dark:text-surface-300 leading-tight"> Dietas montadas </span>
                    </div>
                </div>

                <div class="bg-surface-0 dark:bg-surface-900 rounded-2xl p-5 shadow-sm">
                    <div class="flex justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <span class="text-surface-700 dark:text-surface-300 leading-tight font-normal">Medições</span>

                            <div>
                                <p
                                    class="text-surface-900 dark:text-surface-0 text-2xl! leading-tight! font-semibold"
                                >
                                    {{ measurements }}
                                </p>
                            </div>

                        </div>
                        <Link :href="route('diet.index')">
                            <div class="bg-success flex h-10 w-10 items-center justify-center rounded-lg bg-yellow-500">
                                <i class="pi pi-chart-line text-surface-0 dark:text-surface-900 text-xl! leading-none! text-white" />
                            </div>
                        </Link>
                    </div>
                    <div class="mt-4">
                        <span class="text-surface-500 dark:text-surface-300 leading-tight"> Medições realizadas </span>
                    </div>
                </div>

                <div class="bg-surface-0 dark:bg-surface-900 rounded-2xl p-5 shadow-sm">
                    <div class="flex justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <span class="text-surface-700 dark:text-surface-300 leading-tight font-normal">Feedback</span>
                            <div class="text-surface-900 dark:text-surface-0 text-2xl! leading-tight! font-semibold">152</div>
                        </div>
                        <Link :href="route('diet.index')">
                            <div class="bg-success flex h-10 w-10 items-center justify-center rounded-lg bg-orange-500">
                                <i class="pi pi-envelope text-surface-0 dark:text-surface-900 text-xl! leading-none! text-white" />
                            </div>
                        </Link>
                    </div>
                    <div class="mt-4">
                        <span class="text-surface-500 dark:text-surface-300 leading-tight"> Feedbacks dos alunos </span>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
