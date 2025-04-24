<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dados Pessoais',
        href: '/personal-datas',
    },
];

defineProps<{
    title: string
    measurements: Array<{
        id: number
        name: string
        age: number
        height: number
        weight: number
        arm_l?: number
        arm_r?: number
        chest?: number
        waist?: number
        scruff?: number
        thigh_l?: number
        thigh_r?: number
        calf?: number
        created_at: string
    }>
}>()
</script>

<template>

    <Head :title="title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />

                <div class="p-6 max-w-7xl mx-auto">
                    <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ title }}</h1>

                    <div class="overflow-x-auto bg-white dark:bg-neutral-900 shadow-lg">
                        <table class="min-w-full table-auto text-sm text-left">
                            <thead
                                class="dark:bg-neutral-800 bg-neutral-500 text-white border  dark:border-b-neutral-500 border-b-black">
                                <tr>
                                    <th class="p-3">Idade</th>
                                    <th class="p-3">Altura</th>
                                    <th class="p-3">Peso</th>
                                    <th class="p-3">Peitoral</th>
                                    <th class="p-3">Cintura</th>
                                    <th class="p-3">Braço E.</th>
                                    <th class="p-3">Braço D.</th>
                                    <th class="p-3">Coxa E.</th>
                                    <th class="p-3">Coxa D.</th>
                                    <th class="p-3">Panturrilha</th>
                                    <th class="p-3">Pescoço</th>
                                    <th class="p-3">Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in measurements" :key="item.id"
                                    class="border-b hover:bg-blue-50 dark:hover:bg-neutral-800">
                                    <td class="p-3">{{ item.age }}</td>
                                    <td class="p-3">{{ item.height }} cm</td>
                                    <td class="p-3">{{ item.weight }} kg</td>
                                    <td class="p-3">{{ item.chest || '-' }}</td>
                                    <td class="p-3">{{ item.waist || '-' }}</td>
                                    <td class="p-3">{{ item.arm_l || '-' }}</td>
                                    <td class="p-3">{{ item.arm_r || '-' }}</td>
                                    <td class="p-3">{{ item.thigh_l || '-' }}</td>
                                    <td class="p-3">{{ item.thigh_r || '-' }}</td>
                                    <td class="p-3">{{ item.calf || '-' }}</td>
                                    <td class="p-3">{{ item.scruff || '-' }}</td>
                                    <td class="p-3 text-xs text-gray-500">{{ new
                                        Date(item.created_at).toLocaleDateString() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-span-1 md:col-span-2 mt-4">
                        
                        <a :href="route('personal-datas.create')">
                            <div class="bg-lime-500 hover:opacity-90 transition duration-200 cursor-pointer rounded-md w-1/4 flex m-auto justify-center py-2 mt-52">
                                <p class="text-lg text-white font-extrabold">Nova medida</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
