<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
}>()

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
                    <div class="m-auto w-1/5">
                        <Link :href="route('foods.create')">
                            <Button label="Cadastrar Alimento" class="w-full" severity="success" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
