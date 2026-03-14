<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    title: string;
    students: any[];
    measurements: any[];
}>();

const images = [
    {
        itemImageSrc: 'https://picsum.photos/id/237/800/500',
        thumbnailImageSrc: 'https://picsum.photos/id/237/150/100',
        alt: 'Imagem 1',
    },
    {
        itemImageSrc: 'https://picsum.photos/id/238/800/500',
        thumbnailImageSrc: 'https://picsum.photos/id/238/150/100',
        alt: 'Imagem 2',
    },
    {
        itemImageSrc: 'https://picsum.photos/id/239/800/500',
        thumbnailImageSrc: 'https://picsum.photos/id/239/150/100',
        alt: 'Imagem 3',
    },
];
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
                                        <img :src="slotProps.item.itemImageSrc" :alt="slotProps.item.alt" style="width: 100%" />
                                    </template>
                                    <template #thumbnail="slotProps">
                                        <img :src="slotProps.item.thumbnailImageSrc" :alt="slotProps.item.alt" />
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

                            <!--calculos-->
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
                                            <span class="font-bold">
                                                123
                                            </span>
                                        </div>
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Carboidratos diários</p>
                                            <span class="font-bold">
                                                123
                                            </span>
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Proteínas diárias</p>
                                            <span class="font-bold">
                                                123
                                            </span>
                                        </div>
                                        <div class="m-auto flex max-w-1/2 justify-between gap-2 border-b-2">
                                            <p>Mínimo de água:</p>
                                            <span class="font-bold">
                                                123
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
