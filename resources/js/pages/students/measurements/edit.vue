<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

type Measurement = {
    name?: string;
    description?: string;
    height?: number;
    weight?: number;
    arm_l?: number;
    arm_r?: number;
    chest?: number;
    waist?: number;
    scruff?: number;
    thigh_l?: number;
    thigh_r?: number;
    calf_l?: number;
    calf_r?: number;
};

const props = defineProps<{
    title?: string;
    measurement: Measurement;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Nova medida', href: '/measurements' }];

const formFields = [
    {
        label: 'Titulo *',
        name: 'name',
        type: 'string',
        required: true,
    },
    {
        label: 'Descrição',
        name: 'description',
        type: 'string',
        required: false,
    },
    {
        label: 'Altura (cm) *',
        name: 'height',
        type: 'number',
        step: '0.01',
        required: true,
    },
    {
        label: 'Peso (kg) *',
        name: 'weight',
        type: 'number',
        step: '0.01',
        required: true,
    },
    {
        label: 'Braço Esquerdo (cm)',
        name: 'arm_l',
        type: 'number',
        step: '0.01',
        required: false,
    },
    {
        label: 'Braço Direito (cm)',
        name: 'arm_r',
        type: 'number',
        step: '0.01',
        required: false,
    },
    {
        label: 'Peitoral (cm)',
        name: 'chest',
        type: 'number',
        step: '0.01',
        required: false,
    },
    {
        label: 'Cintura (cm) *',
        name: 'waist',
        type: 'number',
        step: '0.01',
        required: true,
    },
    {
        label: 'Pescoço (cm) *',
        name: 'scruff',
        type: 'number',
        step: '0.01',
        required: true,
    },
    {
        label: 'Coxa Esquerda (cm)',
        name: 'thigh_l',
        type: 'number',
        step: '0.01',
        required: false,
    },
    {
        label: 'Coxa Direita (cm)',
        name: 'thigh_r',
        type: 'number',
        step: '0.01',
        required: false,
    },
    {
        label: 'Panturrilha Esquerda (cm)',
        name: 'calf_l',
        type: 'number',
        step: '0.01',
        required: false,
    },
    {
        label: 'Panturrilha Direita (cm)',
        name: 'calf_r',
        type: 'number',
        step: '0.01',
        required: false,
    },
];

const form = useForm({
    name: props.measurement?.name ?? '',
    description: props.measurement?.description ?? '',
    height: props.measurement?.height ?? '',
    weight: props.measurement?.weight ?? '',
    arm_l: props.measurement?.arm_l ?? '',
    arm_r: props.measurement?.arm_r ?? '',
    chest: props.measurement?.chest ?? '',
    waist: props.measurement?.waist ?? '',
    scruff: props.measurement?.scruff ?? '',
    thigh_l: props.measurement?.thigh_l ?? '',
    thigh_r: props.measurement?.thigh_r ?? '',
    calf_l: props.measurement?.calf_l ?? '',
    calf_r: props.measurement?.calf_r ?? '',
});

function submit() {
    form.put(route('measurements.update', props.measurement.id));
}
</script>

<template>
    <Head :title="title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <PlaceholderPattern />
                <div class="mx-auto max-w-7xl p-6">
                    <h1 class="mb-6 text-2xl font-bold dark:text-white">{{ title }}</h1>

                    <div class="flex h-full w-full items-center justify-center">
                        <form @submit.prevent="submit" class="grid w-full max-w-4xl grid-cols-1 gap-6 rounded-2xl p-8 shadow-xl md:grid-cols-2">
                            <div v-for="(field, index) in formFields" :key="index">
                                <label :for="field.name" class="mb-1 block text-sm font-semibold dark:text-gray-50">
                                    {{ field.label }}
                                </label>
                                <input
                                    :type="field.type"
                                    :name="field.name"
                                    :step="field.step"
                                    v-model="form[field.name]"
                                    :required="field.required"
                                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />
                            </div>

                            <div class="col-span-1 mt-4 md:col-span-2">
                                <Button label="Atualizar medidas" severity="success" class="w-full" type="submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
