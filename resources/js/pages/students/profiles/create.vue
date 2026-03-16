<script setup lang="ts">
import ProfileRequiredDialog from '@/components/ProfileRequiredDialog.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    title?: string;
    profile?: Profile;
    hasProfile: boolean;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Conclua seus dados pessoais', href: '/profile/create' }];

const formFields = [
    {
        label: 'Nome popular',
        placeholder: 'Nome que gostaria de ser chamado',
        name: 'nickname',
        type: 'text',
        required: false,
    },
    {
        label: 'Data de nascimento *',
        name: 'date_birth',
        type: 'date',
        required: true,
    },
    {
        label: 'Genero *',
        name: 'gender',
        type: 'select',
        required: true,
        options: [
            {
                label: 'Masculino',
                value: 'male',
            },
            {
                label: 'Feminino',
                value: 'female',
            },
        ],
    },
];

type Profile = {
    type: string;
    nickname?: string;
    date_birth: string;
    gender?: string;
};

const form = useForm({
    type: props.profile?.type ?? '',
    nickname: props.profile?.nickname ?? '',
    date_birth: props.profile?.date_birth ?? 0,
    gender: props.profile?.gender ?? ''
});

function submit() {
    form.post(route('profile.store'));
}
</script>

<template>
    <Head :title="title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <ProfileRequiredDialog :hasProfile="hasProfile" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <div class="mx-auto max-w-7xl p-6">
                    <h1 class="mb-6 text-2xl font-bold dark:text-white">{{ title }}</h1>
                    <div class="flex h-full w-full items-center justify-center">
                        <form @submit.prevent="submit" class="w-full max-w-4xl space-y-5 rounded-2xl p-8 shadow-xl">
                            <div v-for="(field, index) in formFields" :key="index">
                                <label :for="field.name" class="mb-1 block text-sm font-semibold dark:text-gray-50">
                                    {{ field.label }}
                                </label>

                                <!-- INPUT -->
                                <input
                                    v-if="field.type !== 'select'"
                                    :type="field.type"
                                    :name="field.name"
                                    :placeholder="field.placeholder"
                                    v-model="form[field.name as keyof typeof form]"
                                    :required="field.required"
                                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />

                                <!-- SELECT -->
                                <select
                                    v-else
                                    :name="field.name"
                                    v-model="form[field.name as keyof typeof form]"
                                    :required="field.required"
                                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                >
                                    <option v-for="(option, i) in field.options" :key="i" :value="option.value">
                                        {{ option.label }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-span-1 mt-4 md:col-span-2">
                                <Button label="Finalizar Cadastro" severity="success" class="w-full" type="submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
