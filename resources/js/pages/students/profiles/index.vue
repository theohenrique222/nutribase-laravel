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
    title: string;
    personalData: Array<{
        id: number;
        age: number;
        height: number;
        weight: number;
        gender: string;
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
    }>;
}>();
</script>

<template>
    <Head :title="title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <div class="mx-auto max-w-7xl p-6">
                    <h1 class="mb-6 text-2xl font-bold dark:text-white">{{ title }}</h1>

                    <div class="overflow-x-auto bg-white shadow-lg dark:bg-neutral-900">
                        <!--                        <table class="min-w-full table-auto text-sm text-left">-->
                        <!--                            <thead-->
                        <!--                                class="dark:bg-neutral-800 bg-neutral-500 text-white border  dark:border-b-neutral-500 border-b-black">-->
                        <!--                                <tr>-->
                        <!--                                    <th class="p-3">Altura</th>-->
                        <!--                                    <th class="p-3">Peso</th>-->
                        <!--                                    <th class="p-3">Pescoço</th>-->
                        <!--                                    <th class="p-3">Peitoral</th>-->
                        <!--                                    <th class="p-3">Cintura</th>-->
                        <!--                                    <th class="p-3">Braço E.</th>-->
                        <!--                                    <th class="p-3">Braço D.</th>-->
                        <!--                                    <th class="p-3">Coxa E.</th>-->
                        <!--                                    <th class="p-3">Coxa D.</th>-->
                        <!--                                    <th class="p-3">Panturrilha E.</th>-->
                        <!--                                    <th class="p-3">Panturrilha D.</th>-->
                        <!--                                    <th class="p-3">Atualização</th>-->
                        <!--                                </tr>-->
                        <!--                            </thead>-->
                        <!--                            <tbody>-->
                        <!--                                <tr v-for="item in personalData" :key="item.id"-->
                        <!--                                    class="border-b hover:bg-blue-50 dark:hover:bg-neutral-800 text-center">-->
                        <!--                                    <td class="p-3">{{ item.height }} cm</td>-->
                        <!--                                    <td class="p-3">{{ item.weight }} kg</td>-->
                        <!--                                    <td class="p-3">{{ item.chest }} cm</td>-->
                        <!--                                    <td class="p-3">{{ item.scruff }} cm</td>-->
                        <!--                                    <td class="p-3">{{ item.waist }} cm</td>-->
                        <!--                                    <td class="p-3">{{ item.arm_l }} cm</td>-->
                        <!--                                    <td class="p-3">{{ item.arm_r }} cm</td>-->
                        <!--                                    <td class="p-3">{{ item.thigh_l }} cm</td>-->
                        <!--                                    <td class="p-3">{{ item.thigh_r }} cm</td>-->
                        <!--                                    <td class="p-3">{{ item.calf_l }} cm</td>-->
                        <!--                                    <td class="p-3">{{ item.calf_r }} cm</td>-->
                        <!--                                    <td class="p-3">{{ new Date(item.created_at).toLocaleDateString() }}</td>-->
                        <!--                                </tr>-->
                        <!--                            </tbody>-->
                        <!--                        </table>-->

                        <Card style="width: 25rem; overflow: hidden">
                            <template #header>
                                <img alt="user header" src="/img/avatar.webp" />
                            </template>
                            <template #title>
                                <p class="text-center">Medidas referente ao mês</p>
                            </template>
                            <template #subtitle>
                                <p class="text-center">04/10/2026</p>
                            </template>
                            <template #content>
                                <p class="m-0 text-center">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam
                                    deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse, cupiditate
                                    neque quas!
                                </p>
                            </template>
                            <template #footer>
                                <div class="mt-1 flex gap-4">
                                    <Button label="Ver Detalhes" class="w-full" severity="success" />
                                </div>
                            </template>
                        </Card>
                    </div>

                    <div class="col-span-1 mt-4 md:col-span-2">
                        <a :href="route('profile.create')">
                            <div
                                class="m-auto mt-5 flex w-1/4 cursor-pointer justify-center rounded-md bg-lime-500 py-2 transition duration-200 hover:opacity-90"
                            >
                                <p class="font-extrabold text-white">Nova medida</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
