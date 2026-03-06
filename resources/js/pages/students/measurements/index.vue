<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dados Pessoais',
        href: 'measurements',
    },
];

defineProps<{
    title: string;
    measurements: Array<{
        id: number;
        name: string;
        description?: string;
        height: number;
        weight: number;
        scruff?: number;
        chest?: number;
        waist?: number;
        arm_l?: number;
        arm_r?: number;
        thigh_l?: number;
        thigh_r?: number;
        calf_l?: number;
        calf_r?: number;
        created_at: string;
    }>;
}>();
</script>

<template>
    <Head :title="title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <div class="mx-auto max-w-7xl p-6">
                    <h1 class="mb-6 text-2xl font-bold dark:text-white">
                        {{ title }}
                    </h1>

                    <div v-for="measurement in measurements" :key="measurement.id" class="flex w-full justify-center">
                        <Card style="width: 25rem; overflow: hidden">
                            <template #header>
                                <img alt="user header" src="/img/avatar.webp" />
                            </template>
                            <template #title>
                                <p class="text-center">
                                    {{ measurement.name }}
                                </p>
                            </template>
                            <template #subtitle>
                                <p class="mb-2 text-center">Criado em {{ new Date(measurement.created_at).toLocaleDateString('pt-BR') }}</p>
                                <p class="text-center">
                                   Atualiazdo em {{ new Date(measurement.updated_at).toLocaleDateString('pt-BR') }}
                                </p>
                            </template>
                            <template #content>
                                <p class="m-0 text-center">
                                    {{ measurement.description }}
                                </p>
                            </template>
                            <template #footer>
                                <div class="mt-1 flex w-full justify-center gap-4">
                                    <Link :href="route('measurements.edit', measurement.id)">
                                        <Button label="Atualizar" severity="success" class="w-full" variant="outlined" />
                                    </Link>

                                    <Button label="Ver Detalhes" class="" severity="success" />
                                </div>
                            </template>
                        </Card>
                    </div>

                    <div class="col-span-1 mt-4 flex justify-center md:col-span-2">
                        <div>
                            <Link :href="route('measurements.create')">
                                <Button label="Cadastrar Nova medida" class="w-full" severity="success" />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
