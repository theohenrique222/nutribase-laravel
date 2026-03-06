<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{ title?: string }>();

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Nova medida', href: '/profile' }];

const formFields = [
    {
        label: 'Titulo *',
        name: 'title',
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
    title: null,
    description: null,
    height: null,
    weight: null,
    arm_l: null,
    arm_r: null,
    chest: null,
    waist: null,
    scruff: null,
    thigh_l: null,
    thigh_r: null,
    calf_l: null,
    calf_r: null,
});

function submit() {
    form.post(route('profile.store'));
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
                                    :value="field.value"
                                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />
                            </div>

                            <div class="col-span-1 mt-4 md:col-span-2">
                                <Button label="Salvar medidas" severity="success" class="w-full" type="submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
