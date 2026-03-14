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

const {
    calcBasal,
    calcWater,
    calcCarbs,
    calcFat,
    calcProteins,
    } = defineProps<
    {
    title: string;
    calcBasal: number;
    calcWater: number;
    calcCarbs: number;
    calcFat: number;
    calcProteins: string;
    tests: any;
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

const stats = [
    {
        label: 'Metabolismo Basal:',
        value: calcBasal
    },
    {
        label: 'Carboidratos diários:',
        value: calcCarbs,
    },
    {
        label: 'Proteinas diárias:',
        value: calcProteins,
    },
    {
        label: 'Ingestão de água diaria',
        value: calcWater
    },
    {
        label: 'Gordura corporal aproximada',
        value: calcFat,
    }

]
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

                    <div>
                        {{ tests }}
                    </div>
                    <div v-for="measurement in measurements" :key="measurement.id" class="flex w-full justify-center">
                        <div class="p-5 shadow-lg">
                            <div class="mb-10 flex w-full p-3 bg-emerald-500 text-white rounded-lg">
                                <div class="m-auto flex gap-10 text-lg">
                                    <p>
                                        Altura:
                                        <span class="font-bold">
                                            {{ measurement.height }}
                                        </span>
                                    </p>
                                    <p>
                                        Peso:
                                        <span class="font-bold">
                                            {{ measurement.weight }}
                                        </span>
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

                            <div class="mb-5 flex justify-center gap-10 p-3 bg-emerald-500 text-center text-lg text-white rounded-lg">
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
                            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2">

                                <!-- Lado Esquerdo -->
                                <div class="rounded-xl border bg-white p-4 shadow-sm">
                                    <h3 class="mb-3 text-sm font-semibold text-gray-700 uppercase">
                                        Lado esquerdo
                                    </h3>

                                    <div class="space-y-2">
                                        <div class="flex justify-between border-b pb-1">
                                            <span>Braço</span>
                                            <span class="font-bold">{{ measurement.arm_l }}</span>
                                        </div>

                                        <div class="flex justify-between border-b pb-1">
                                            <span>Coxa</span>
                                            <span class="font-bold">{{ measurement.thigh_l }}</span>
                                        </div>

                                        <div class="flex justify-between">
                                            <span>Panturrilha</span>
                                            <span class="font-bold">{{ measurement.calf_l }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Lado Direito -->
                                <div class="rounded-xl border bg-white p-4 shadow-sm">
                                    <h3 class="mb-3 text-sm font-semibold text-gray-800 uppercase">
                                        Lado direito
                                    </h3>

                                    <div class="space-y-2">
                                        <div class="flex justify-between border-b pb-1">
                                            <span>Braço</span>
                                            <span class="font-bold">{{ measurement.arm_r }}</span>
                                        </div>

                                        <div class="flex justify-between border-b pb-1">
                                            <span>Coxa</span>
                                            <span class="font-bold">{{ measurement.thigh_r }}</span>
                                        </div>

                                        <div class="flex justify-between">
                                            <span>Panturrilha</span>
                                            <span class="font-bold">{{ measurement.calf_r }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--cálculos-->

                            <div class="mb-5 flex justify-center gap-10 p-3 bg-emerald-500 text-center text-lg text-white rounded-lg">
                                <div>
                                    <p>Calculo com base nos dados corporais</p>
                                </div>
                            </div>
                            <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                                <div
                                    v-for="state in stats"
                                    :key="state.label"
                                    class="rounded-2xl border bg-white p-4 shadow-sm transition hover:shadow-md"
                                >
                                    <p class="text-sm text-gray-500">
                                        {{ state.label }}
                                    </p>

                                    <p class="mt-2 text-2xl font-bold text-gray-700">
                                        {{ state.value }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex w-full justify-center gap-4">
                                <Link :href="route('measurements.edit', measurement.id)">
                                    <Button label="Atualizar medidas" severity="info" />
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
