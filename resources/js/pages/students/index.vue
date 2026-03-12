<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import ConfirmPopup from 'primevue/confirmpopup';

defineProps<{
    title?: string;
    students?: any[];
}>();

function show(id: number) {
    router.visit(route('diet.show', id));
}

function edit(id: number) {
    router.visit(route('students.edit', id));
}

const confirm = useConfirm();

function destroy(event: Event, id: number) {
    confirm.require({
        target: event.currentTarget as HTMLElement,
        message: 'Tem certeza que deseja excluir este aluno?',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('students.destroy', id));
        },
    });
}
</script>

<template>
    <ConfirmPopup />
    <Head :title="title" />
    <AppLayout>
        <Toast position="bottom-center" group="bc" @close="onClose">
            <template #message="slotProps">
                <div class="flex flex-auto flex-col items-start">
                    <div class="flex items-center gap-2">
                        <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" shape="circle" />
                        <span class="font-bold">Amy Elsner</span>
                    </div>
                    <div class="my-4 text-lg font-medium">{{ slotProps.message.summary }}</div>
                    <Button size="small" label="Reply" severity="success" @click="onReply()"></Button>
                </div>
            </template>
        </Toast>
        <Button @click="showTemplate" label="View" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative flex-1 rounded-xl border">
                <div class="mx-auto max-w-7xl p-6">
                    <h1 class="mb-6 text-2xl font-bold dark:text-white">
                        {{ title }}
                    </h1>
                    <div v-if="!students || students.length === 0" class="text-center">
                        <h2 class="p-10">Você ainda não possui Alunos cadastrados.</h2>
                    </div>
                    <div v-else>
                        <div v-if="students" class="flex h-full w-full items-center justify-center">
                            <DataTable :value="students" tableStyle="min-width: 50rem">
                                <Column field="id" header="Matricula" sortable style="width: 10%"></Column>
                                <Column field="user.name" header="Nome do aluno" sortable style="width: 50%"></Column>
                                <Column header="Ações" style="width: 25%">
                                    <template #body="slotProps">
                                        <div class="flex w-full justify-around">
                                            <Button icon="pi pi-clipboard" class="mr-2" @click="show(slotProps.data.id)" />
                                            <Button icon="pi pi-pencil" severity="warn" class="mr-2" @click="edit(slotProps.data.id)" />
                                            <Button icon="pi pi-trash" severity="danger" @click="destroy($event, slotProps.data.id)" />
                                        </div>
                                    </template>
                                </Column>
                            </DataTable>
                        </div>
                    </div>
                </div>
                <div class="m-auto w-1/2">
                    <Link :href="route('students.create')">
                        <Button label="Cadastrar Aluno" class="w-full" severity="success" />
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
