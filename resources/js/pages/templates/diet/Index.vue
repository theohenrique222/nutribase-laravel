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
                    
                </div>
            </div>
        </div>
    </AppLayout>
</template>