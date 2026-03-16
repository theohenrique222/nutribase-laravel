<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ProfileRequiredDialog from '@/components/ProfileRequiredDialog.vue';

const props = defineProps<{
    title?: string;
}>();

const formFields = [
    {
        label: 'Apelido',
        name: 'nickname',
        placeholder: 'Nome que você gosta de ser chamado',
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

const form = useForm({
    nickname: props.measurement?.name ?? '',
    date_birth: props.measurement?.description ?? '',
    gender: props.measurement?.height ?? '',
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
                <PlaceholderPattern />
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
                                    :step="field.step"
                                    :placeholder="field.placeholder"
                                    v-model="form[field.name]"
                                    :required="field.required"
                                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />

                                <!-- SELECT -->

                                <select
                                    v-else
                                    :name="field.name"
                                    v-model="form[field.name]"
                                    :required="field.required"
                                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                >
                                    <option value="">Selecione seu gênero</option>
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
