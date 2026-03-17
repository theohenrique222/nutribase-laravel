<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const visible = ref(false);

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

const { calcBasal, calcWater, calcCarbs, calcFat, calcProteins, student } = defineProps<{
    title: string;
    coach: any;
    student: any;
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
        value: calcBasal,
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
        value: calcWater,
    },
    {
        label: 'Gordura corporal aproximada',
        value: calcFat,
    },
];

const formFields = [
    {
        label: 'Descrição',
        name: 'description',
        type: 'string',
        placeholder: 'Exemplo: Em adaptação aos treinos',
        required: false,
    },
    {
        label: 'Foto:',
        name: 'photo',
        type: 'file',
        required: false,
    },
    {
        label: 'Altura (cm) *',
        name: 'height',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 170',
        required: true,
    },
    {
        label: 'Peso (kg) *',
        name: 'weight',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo 80',
        required: true,
    },
    {
        label: 'Braço Esquerdo (cm)',
        name: 'arm_l',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 40',
        required: false,
    },
    {
        label: 'Braço Direito (cm)',
        name: 'arm_r',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 40',
        required: false,
    },
    {
        label: 'Peitoral (cm)',
        name: 'chest',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 120',
        required: false,
    },
    {
        label: 'Cintura (cm) *',
        name: 'waist',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 90',
        required: true,
    },
    {
        label: 'Quadril (cm) *',
        name: 'hip',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo 120',
        required: true,
    },
    {
        label: 'Pescoço (cm) *',
        name: 'scruff',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 80',
        required: true,
    },
    {
        label: 'Coxa Esquerda (cm)',
        name: 'thigh_l',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 80',
        required: false,
    },
    {
        label: 'Coxa Direita (cm)',
        name: 'thigh_r',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 80',
        required: false,
    },
    {
        label: 'Panturrilha Esquerda (cm)',
        name: 'calf_l',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 80',
        required: false,
    },
    {
        label: 'Panturrilha Direita (cm)',
        name: 'calf_r',
        type: 'number',
        step: '0.01',
        placeholder: 'Exemplo: 80',
        required: false,
    },
];

const form = useForm({
    student_id: 0,
    description: null,
    height: null,
    weight: null,
    arm_l: null,
    arm_r: null,
    chest: null,
    waist: null,
    scruff: null,
    hip: null,
    thigh_l: null,
    thigh_r: null,
    calf_l: null,
    calf_r: null,
});

function openModal() {
    form.student_id = student
    console.log(form.student_id)
    visible.value = true
}

function submit() {
    form.post(route('measurements.store'));
}
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
                            <div class="mb-10 flex w-full rounded-lg bg-emerald-500 p-3 text-white">
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

                            <div class="mb-5 flex justify-center gap-10 rounded-lg bg-emerald-500 p-3 text-center text-lg text-white">
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
                                    <h3 class="mb-3 text-sm font-semibold text-gray-700 uppercase">Lado esquerdo</h3>

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
                                    <h3 class="mb-3 text-sm font-semibold text-gray-800 uppercase">Lado direito</h3>

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

                            <div class="mb-5 flex justify-center gap-10 rounded-lg bg-emerald-500 p-3 text-center text-lg text-white">
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
                        <div v-if="coach">
                                <h3 class="p-10">Seu aluno não possui medidas cadastradas.</h3>
                                <Button
                                    @click="openModal()"
                                    label="Cadastrar medida"
                                    class="w-full"
                                    severity="success"
                                />

                        </div>
                    </div>

                    <Dialog v-model:visible="visible" modal header="Edit Profile" :style="{ width: '50rem' }">
                        <form @submit.prevent="submit" class="w-full max-w-4xl gap-6 space-y-5 rounded-2xl p-8 shadow-xl">
                            <div v-for="(field, index) in formFields" :key="index">
                                <label :for="field.name" class="mb-1 block text-sm font-semibold dark:text-gray-50">
                                    {{ field.label }}
                                </label>
                                <input
                                    :type="field.type"
                                    :name="field.name"
                                    :step="field.step"
                                    v-model="form[field.name as keyof typeof form]"
                                    :required="field.required"
                                    :placeholder="field.placeholder"
                                    class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />
                            </div>

                            <div class="col-span-1 mt-4 md:col-span-2">
                                <Button label="Salvar medidas" severity="success" class="w-full" type="submit" />
                            </div>
                        </form>
                    </Dialog>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
