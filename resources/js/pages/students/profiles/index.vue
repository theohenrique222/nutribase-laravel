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
    profile: Array<{
        id: number;
        title: string;
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
    }>;
}>();
</script>

<template>
    <Head :title="title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 rounded-xl"
        >
            <div
                class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min"
            >
                <div
                    class="mx-auto max-w-7xl p-6"
                >
                    <h1
                        class="mb-6 text-2xl font-bold dark:text-white"
                    >
                        {{ title }}
                    </h1>

                    <div
                        v-for="profile in profile"
                        :key="profile.id"
                        class="w-full justify-center flex"
                    >
                        <Card
                            style="width: 25rem;
                            overflow: hidden"
                        >
                            <template
                                #header
                            >
                                <img
                                    alt="user header"
                                    src="/img/avatar.webp"
                                />
                            </template>
                            <template
                                #title
                            >
                                <p
                                    class="text-center"
                                >
                                    {{ profile.title }}
                                </p>
                            </template>
                            <template
                                #subtitle
                            >
                                <p
                                    class="text-center"
                                >
                                    {{ new Date(profile.created_at).toLocaleDateString('pt-BR') }}
                                </p>
                            </template>
                            <template
                                #content>
                                <p
                                    class="m-0 text-center"
                                >
                                    {{ profile.description }}
                                </p>
                            </template>
                            <template
                                #footer
                            >
                                <div
                                    class="mt-1 flex gap-4 justify-center w-full"
                                >
                                        <Link
                                            :href="route('profile.edit')"
                                        >
                                            <Button
                                                label="Atualizar"
                                                severity="success"
                                                class="w-full"
                                                variant="outlined"
                                            />
                                        </Link>

                                        <Button
                                            label="Ver Detalhes"
                                            class=""
                                            severity="success"

                                        />
                                </div>
                            </template>
                        </Card>
                    </div>

                    <div
                        class="col-span-1 mt-4 md:col-span-2 flex justify-center"
                    >
                        <div v-if="profile !== null">
                            <Link
                                :href="route('profile.create')"
                            >
                                <Button
                                    label="Cadastrar Nova medida"
                                    class="w-full"
                                    severity="success"
                                />
                            </Link>
                        </div>

                        <div>
                            <Link
                                :href="route('profile.update')"
                            >
                                <Button
                                    label="Cadastrar medidas"
                                    class="w-full"
                                    severity="success"
                                />
                            </Link>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </AppLayout>
</template>
