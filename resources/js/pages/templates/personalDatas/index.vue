<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


defineProps<{
        title?: string
        personalData: any[]
}>();

const theads = [ 'Altura', 'Peso', 'Pescoço', 'Peitoral', 'Cintura', 'Braço Esquero' ];

const columns = [
        { label: 'Altura', field: 'height', suffix: ' cm' },
        { label: 'Peso', field: 'weight', suffix: ' kg' },
        { label: 'Pescoço', field: 'scruff', suffix: ' cm' },
        { label: 'Peitoral', field: 'chest', suffix: ' cm' },
        { label: 'Cintura', field: 'waist', suffix: ' cm' },
        { label: 'Braço Esquerdo', field: 'arm_l', suffix: ' cm' },
]

</script>

<template>

    <Head :title="title" />

    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="p-6 max-w-7xl mx-auto">
                    <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ title }}</h1>

                    <div class="overflow-x-auto bg-white dark:bg-neutral-900 shadow-lg">
                        <table class="min-w-full table-auto text-sm text-left">
                            <thead
                                class="dark:bg-neutral-800 bg-neutral-500 text-white border  dark:border-b-neutral-500 border-b-black">
                                <tr class="text-center">
                                    <th v-for="col in columns" :key="col.field" class="p-3">
                                        {{ col.label }}
                                    </th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <tr v-for="data in personalData" :key="data.id"
                                    class="border-b hover:bg-blue-50 dark:hover:bg-neutral-800 text-center">
                                    <td v-for="col in columns" :key="col.field"
                                        class="p-3">{{ data[col.field] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-span-1 md:col-span-2 mt-4">
                        <a :href="route('personal-datas.create')">
                            <div
                                class="bg-lime-500 hover:opacity-90 transition duration-200 cursor-pointer rounded-md w-1/4 flex m-auto justify-center py-2 mt-5">
                                <p class="text-white font-extrabold">Nova medida</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
