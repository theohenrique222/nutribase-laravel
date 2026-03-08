<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import ConfirmPopup from 'primevue/confirmpopup';

defineProps<{
    title?: string;
    coaches?: any[];
}>();

function show(id: number) {
    router.visit(route('students.show', id));
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
    <Head :title="title" />
    <ConfirmPopup />
    <AppLayout>
        <div class="col-span-1 mt-4 flex justify-center md:col-span-2">
            <div v-if="!coaches || coaches.length === 0">
                <h3 class="p-10">Você ainda não possui coaches cadastrados.</h3>
            </div>

            <div v-else>
                <div v-if="coaches" class="flex h-full w-full items-center justify-center">
                    <DataTable :value="coaches" tableStyle="min-width: 50rem">
                        <Column field="id" header="Matricula" sortable style="width: 10%"></Column>
                        <Column field="user.name" header="Nome do aluno" sortable style="width: 50%"></Column>
                        <Column header="Ações" style="width: 25%">
                            <template #body="slotProps">
                                <Button icon="pi pi-eye" class="mr-2" @click="show(slotProps.data.id)" />
                                <Button icon="pi pi-pencil" class="mr-2" @click="edit(slotProps.data.id)" />
                                <Button icon="pi pi-trash" severity="danger" @click="destroy($event, slotProps.data.id)" />
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
                <div>
                    <Link :href="route('coach.create')">
                        <Button label="Cadastrar Coach" class="w-full" severity="success" />
                    </Link>
                </div>
    </AppLayout>
</template>

<style scoped></style>
