<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const visible = ref(false);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dados Pessoais',
        href: 'measurements',
    },
];

defineProps<{
    title: string;
    hasMeasurement: null;
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
        <Dialog v-model:visible="visible" modal header="Header" :style="{ width: '50vw' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <p class="m-0">Para cadastrar medida complete seu perfil</p>
        </Dialog>
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
                                <p class="text-center">Atualiazdo em {{ new Date(measurement.updated_at).toLocaleDateString('pt-BR') }}</p>
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
                                    <Button label="Ver Detalhes" class="" severity="success" @click="visible = true" />
                                </div>
                            </template>
                        </Card>
                        <Dialog v-model:visible="visible" modal header="Detalhes das medidas" :style="{ width: '25rem' }">
                            <div class="text-center">
                                <span class="text-surface-500 dark:text-surface-400 mb-8 block">
                                    <p>
                                        Medidas referente ao mês de
                                        <span class="font-bold">{{ new Date(measurement.updated_at).toLocaleDateString('pt-BR') }}</span>
                                    </p>
                                </span>
                            </div>

                            <span> </span>
                            <div class="mb-4 flex items-center gap-4"></div>
                            <div class="mb-8 flex items-center gap-4">
                                <div class="text-center">
                                    <p>
                                        Braço esquerdo: <span class="font-bold">{{ measurement.arm_l }}</span>
                                    </p>
                                    <p>
                                        Coxa esquerda: <span class="font-bold">{{ measurement.thigh_l }}</span>
                                    </p>
                                    <p>
                                        Pantorrilha esquera: <span class="font-bold">{{ measurement.calf_l }}</span>
                                    </p>
                                </div>
                                <div>
                                    <img src="/img/body.webp" />
                                </div>
                                <div class="text-center">
                                    <p>
                                        Braço direito: <span class="font-bold">{{ measurement.arm_r }}</span>
                                    </p>
                                    <p>
                                        Coxa direita: <span class="font-bold">{{ measurement.thigh_r }}</span>
                                    </p>
                                    <p>
                                        Pantorrilha direita: <span class="font-bold">{{ measurement.calf_r }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-center">
                                <span class="text-surface-500 dark:text-surface-400 mb-8 block">
                                    <p>
                                        Altura: <span class="font-bold">{{ measurement.height }}</span>
                                    </p>
                                    <p>
                                        Peso: <span class="font-bold">{{ measurement.weight }}</span>
                                    </p>
                                </span>
                            </div>
                            <div class="flex justify-end gap-2">
                                <Button type="button" label="Fechar" severity="danger" @click="visible = false"></Button>
                            </div>
                        </Dialog>
                    </div>

                    <div class="col-span-1 mt-4 flex justify-center md:col-span-2">
                        <div v-if="!hasMeasurement">
                            <h3 class="p-10">Você ainda não possui medidas cadastradas.</h3>
                            <Link :href="route('measurements.create')">
                                <Button label="Cadastrar medida" class="w-full" severity="success" />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
