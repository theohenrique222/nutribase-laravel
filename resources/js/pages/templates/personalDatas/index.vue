<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const visible = ref(false);

defineProps<{
        title?: string
        personalData: any[]
}>();

const destroy = (id: number) => {
    router.delete(route('personal-datas.destroy', id))
}

const edit = (id: number) => {
    router.get(route('personal-datas.edit', id))
}

const colunms = [
        { label: 'Altura', field: 'height', suffix: ' cm' },
        { label: 'Peso', field: 'weight', suffix: ' kg' },
        { label: 'Pescoço', field: 'scruff', suffix: ' cm' },
        { label: 'Peitoral', field: 'chest', suffix: ' cm' },
        { label: 'Cintura', field: 'waist', suffix: ' cm' },
        { label: 'Braço Esquerdo', field: 'arm_l', suffix: ' cm' },
]

const datas = [ 'columns.created_at' ]

</script>

<template>

    <Head :title="title" />

    <AppLayout>
        <div 
            class="flex h-full flex-1 flex-col gap-4 rounded-xl"
            >
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min"
                >
                <div 
                    class="p-6 max-w-7xl mx-auto"
                    >
                    <h1 
                        class="text-2xl font-bold mb-6 dark:text-white"
                        >
                        {{ title }}
                    </h1>
                    <div 
                        class="overflow-x-auto bg-white dark:bg-neutral-900 shadow-lg"
                        >
                        <div 
                            class="flex justify-center w-full space-x-5"
                            >
                            <div 
                                v-for="data in personalData" 
                                :key="data.id"
                                >
                                <Card 
                                    style="width: 25rem; overflow: hidden;"
                                    >
                                    <template #header>
                                        <img alt="user header" src="/img/avatar.webp" />
                                    </template>
                                    <template #title>
                                        <p class="text-center">
                                            Avaliação corporal
                                        </p>
                                    </template>
                                    <template #subtitle>
                                        <p class="text-center">
                                            {{ data.created_at_formatted }}
                                        </p>
                                    </template>
                                    <template #content>
                                        <p class="m-0 text-center">
                                            Entre para visualizar ou editar seus dados
                                        </p>
                                    </template>
                                    <template #footer>
                                        <div class="flex gap-4 mt-1">

                                            <Button 
                                                @click="destroy(data.id)"
                                                label="Deletar" severity="danger" variant="outlined" class="w-full" />

                                            <Button 
                                                @click="visible = true"
                                                label="Exibir" severity="success" class="w-full" />

                                        </div>
                                        <Dialog v-model:visible="visible" maximizable modal header="Dados Corporais" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
                                            <span class="text-surface-500 dark:text-surface-400 block mb-8">
                                                <div v-for="data in personalData" :key="data.id" class="p-4 border rounded-lg">
                                                    <div class="text-center w-full pb-5">
                                                        <h3 class="font-semibold mb-2 text-xl">
                                                            <span v-if="data.created_at === data.updated_at">
                                                                Avaliação Criada em {{ data.created_at_formatted }}
                                                            </span>
                                                            <span v-if="data.created_at != data.updated_at">
                                                                Avaliação Atualizada em {{ data.created_at_formatted }}
                                                            </span>
                                                        </h3>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-2 text-lg w-full text-center">
                                                        <p>Altura: {{ data.height }} cm</p>
                                                        <p>Peso: {{ data.weight }} kg</p>
                                                        <p>Peitoral: {{ data.chest }} cm</p>
                                                        <p>Cintura: {{ data.waist }} cm</p>
                                                        <p>Braço Esq: {{ data.arm_l }} cm</p>
                                                        <p>Braço Dir: {{ data.arm_r }} cm</p>
                                                        <p>Coxa Esq: {{ data.thigh_l }} cm</p>
                                                        <p>Coxa Dir: {{ data.thigh_r }} cm</p>
                                                    </div>
                                                </div>
                                            </span>
                                            <div class="flex items-center gap-4 mb-4">
                                                
                                            </div>
                                            <div class="flex justify-end gap-2">
                                                <Button type="button" label="Fechar" severity="secondary" @click="visible = false"></Button>
                                                <Button type="button" label="Editar" severity="warn" @click="edit(data.id)"></Button>
                                            </div>
                                        </Dialog>
                                    </template>
                                </Card>
                            </div>
                        </div>

                        
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
