<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const { calculations } = usePage().props;
const page = usePage();
const successMessage = computed(() => page.props.flash?.success);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Análise Corporal',
        href: '/personal-datas',
    },
];

let metrics = [];

if (calculations.length > 0) {
    const latest = calculations[calculations.length - 1];

    metrics = [
        {
            title: 'Taxa Metabólica Basal',
            subtitle: 'Energia mínima necessária por dia',
            value: latest.tmb,
        },
        {
            title: 'Proteínas',
            subtitle: 'Gramas diárias recomendadas',
            value: latest.proteins,
        },
        {
            title: 'Carboidratos',
            subtitle: 'Gramas diárias recomendadas',
            value: latest.carbohydrates,
        },
        {
            title: 'Gorduras',
            subtitle: 'Gramas diárias recomendadas',
            value: latest.fat,
        },
        {
            title: 'Água Diária',
            subtitle: 'Quantidade de água diária',
            value: latest.water_intake,
        },
        {
            title: 'IMC',
            subtitle: 'Seu índice de massa corporal',
            value: latest.imc,
        },
    ];
}

const props = defineProps<{
    title: string,
    personalData: Array<{
        id: number,
        tmb: { title: string, subtitle: string, value: number },
        waterIntake: { title: string, subtitle: string, value: number },
        imc: { title: string, subtitle: string, value: number },
        proteins: { title: string, subtitle: string, value: number },
        carbohydrates: { title: string, subtitle: string, value: number },
        fats: { title: string, subtitle: string, value: number },
    }>
}>()

function save() {

    const item = props.personalData[0];

    router.post('/calculation', {
        tmb: item.tmb.value,
        proteins: item.proteins.value,
        carbohydrates: item.carbohydrates.value,
        fat: item.fats.value,
        water_intake: item.waterIntake.value,
        imc: item.imc.value
    });
}

</script>


<template>

    <Head :title="title" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min bg-neutral-900">
                <div class="p-6 max-w-7xl mx-auto">
                    <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ title }}</h1>
                    <div v-if="successMessage" class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ successMessage }}
                    </div>
                    <div class="overflow-x-auto bg-white dark:bg-neutral-900">
                      
                        <div class="grid auto-rows-min gap-4 md:grid-cols-3" v-if="metrics.length">
                            <div v-for="(metric, index) in metrics" :key="index"
                                class="bg-neutral-800 relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border text-center p-5">
                                <h2 class="text-2xl font-extrabold p-2">{{ metric.title }}</h2>
                                <h3 class="text-sm font-extralight">{{ metric.subtitle }}</h3>
                                <h3 class="text-2xl font-bold p-2">{{ metric.value }}</h3>
                            </div>
                        </div>
                        
                        <p v-else class="text-center text-gray-400 mt-10">Nenhum cálculo disponível ainda.</p>
                        
                        <div class="w-full text-center p-10">
                            <form @submit.prevent="save">
                                <button type="submit"
                                    class="bg-lime-500 hover:opacity-80 cursor-pointer text-white font-semibold px-8 py-3 rounded-md transition">
                                    Analizar
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
