<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const responsiveOptions = ref();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dados Pessoais',
        href: 'measurements',
    },
];

const images = [
    {
        imageSrc: '/img/avatar.webp',
        alt: 'Imagem 1',
    },
    {
        imageSrc: '/img/avatar.webp',
        alt: 'Imagem 1',
    },
    {
        imageSrc: '/img/avatar.webp',
        alt: 'Imagem 1',
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
        updated_at: string;
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
                        <div class="p-5 shadow-lg">
                            <div class="mb-10 flex w-full bg-emerald-500 text-white">
                                <div class="m-auto flex gap-10 text-lg">
                                    <p>
                                        Altura: <span class="font-bold">{{ measurement.height }}</span>
                                    </p>
                                    <p>
                                        Peso: <span class="font-bold">{{ measurement.weight }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="mb-10 w-full">
                                <Galleria :value="images" :responsiveOptions="responsiveOptions" :numVisible="5">
                                    <template #item="slotProps">
                                        <div class="h-auto w-md">
                                            <img :src="slotProps.item.imageSrc" :alt="slotProps.item.alt" />
                                        </div>
                                    </template>
                                    <template #thumbnail="slotProps">
                                        <div class="w-52">
                                            <img :src="slotProps.item.imageSrc" :alt="slotProps.item.alt" />
                                        </div>
                                    </template>
                                </Galleria>
                            </div>

                            <div class="mb-5 flex justify-center gap-10 bg-emerald-500 text-center text-lg text-white">
                                <div>
                                    <p>Criado em:</p>
                                    <span class="font-bold">
                                        {{ new Date(measurement.created_at).toLocaleDateString('pt-BR') }}
                                    </span>
                                </div>
                                <div>
                                    <p>Ultima atualização:</p>
                                    <span class="font-bold">
                                        {{ new Date(measurement.updated_at).toLocaleDateString('pt-BR') }}
                                    </span>
                                </div>
                            </div>
                            <div class="mb-8 flex items-center gap-4">
                                <div class="flex w-full text-center">
                                    <div class="w-full">
                                        <div class="m-auto flex max-w-1/2 justify-between border-b-2">
                                            <p>Braço esquerdo:</p>
                                            <span class="font-bold">
                                                {{ measurement.arm_l }}
                                            </span>
                                        </div>
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Coxa esquerda:</p>
                                            <span class="font-bold">
                                                {{ measurement.thigh_l }}
                                            </span>
                                        </div>
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Pantorrilha esquerda:</p>
                                            <span class="font-bold">
                                                {{ measurement.calf_l }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Braço esquerdo:</p>
                                            <span class="font-bold">
                                                {{ measurement.arm_l }}
                                            </span>
                                        </div>
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Coxa esquerda:</p>
                                            <span class="font-bold">
                                                {{ measurement.thigh_l }}
                                            </span>
                                        </div>
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Pantorrilha esquerda:</p>
                                            <span class="font-bold">
                                                {{ measurement.calf_l }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--cálculos-->
                            
                            <div class="mb-5 flex justify-center gap-10 bg-emerald-500 text-center text-lg text-white">
                                <div>
                                    <p>Calculo com base nos dados corporais</p>
                                </div>
                            </div>
                            <div class="mb-8 flex items-center gap-4">
                                <div class="flex w-full text-center">
                                    <div class="w-full">
                                        <div class="m-auto flex max-w-1/2 justify-between border-b-2">
                                            <p>Metabolismo basal</p>
                                            <span class="font-bold"> 123 </span>
                                        </div>
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Carboidratos diários</p>
                                            <span class="font-bold"> 123 </span>
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Proteínas diárias</p>
                                            <span class="font-bold"> 123 </span>
                                        </div>
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Mínimo de água:</p>
                                            <span class="font-bold"> 123 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-1 flex w-full justify-center gap-4">
                                <Link :href="route('measurements.edit', measurement.id)">
                                    <Button label="Atualizar medidas" severity="success" class="w-full"/>
                                </Link>
                            </div>
                        </div>
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
