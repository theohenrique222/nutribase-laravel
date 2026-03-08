<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const { title } = defineProps<{
    title?: string;
}>();
</script>

<template>
    <Head :title="title" />
    <AppLayout>
        <div class="col-span-1 mt-4 flex justify-center md:col-span-2">
            <div v-if="!hasMeasurement">
                <h3 class="p-10">Você ainda não possui coaches cadastrados.</h3>
                <Link :href="route('coach.create')">
                    <Button label="Cadastrar Coach" class="w-full" severity="success" />
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
