<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import ConfirmPopup from 'primevue/confirmpopup';
import { ref } from 'vue';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';

defineProps<{
    title?: string;
    students?: any[];
}>();

const visible = ref(false);

const filters = ref({
    global: {
        value: null,
        matchMode: 'contains',
    },
});

function showDiet(id: number) {
    router.visit(route('diet.show', id));
}

function show(id: number) {
    router.visit(route('students.show', id));
}

const editingId = ref<number | null>(null);

function edit(students: any) {
    editingId.value = students.id;

    form.name = students.user.name;
    form.email = students.user.email;

    visible.value = true;
}

function create() {
    form.reset();
    editingId.value = null;
    visible.value = true;
}

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

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

const submit = () => {
    if (editingId.value) {
        form.put(route('students.update', editingId.value), {
            onSuccess: () => {
                alert('Aluno atualizado com sucesso!');
                visible.value = false;
                form.reset();
                editingId.value = null;
            },
        });
    } else {
        form.post(route('students.store'), {
            onSuccess: () => {
                alert('Aluno Cadastrado com sucesso');
                visible.value = false;
                form.reset();
            },
        });
    }
};
</script>

<template>
    <Head :title="title" />
    <ConfirmPopup />
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
                            <DataTable v-model:filters="filters" :value="students" :rows="10" class="w-full">
                                <template #header>
                                    <div class="flex justify-end">
                                        <IconField class="space-x-5">
                                            <InputIcon>
                                                <i class="pi pi-search" />
                                            </InputIcon>
                                            <InputText v-model="filters.global.value" placeholder="Buscar aluno" />
                                        </IconField>
                                    </div>
                                </template>
                                <Column field="id" header="Matricula" sortable style="width: 10%"></Column>
                                <Column field="user.name" header="Nome do aluno" sortable style="width: 50%"></Column>
                                <Column header="Ações" style="width: 25%">
                                    <template #body="slotProps">
                                        <div class="flex w-full justify-around">
                                            <Button icon="pi pi-eye" severity="info" class="mr-2" @click="show(slotProps.data.id)" />
                                            <Button icon="pi pi-clipboard" severity="success" class="mr-2" @click="showDiet(slotProps.data.id)" />
                                            <Button icon="pi pi-pencil" severity="warn" class="mr-2" @click="edit(slotProps.data)" />
                                            <Button icon="pi pi-trash" severity="danger" @click="destroy($event, slotProps.data.id)" />
                                        </div>
                                    </template>
                                </Column>
                            </DataTable>
                        </div>
                    </div>
                </div>
                <div class="m-auto w-1/2">
                    <Button label="Cadastrar Aluno" class="w-full" severity="success" @click="create" />
                </div>

                <Dialog v-model:visible="visible" modal header="Cadastrar aluno" :style="{ width: '50rem' }" class="text-end">
                    <span class="text-surface-500 dark:text-surface-400 mb-5 block text-center">Insira as informações do aluno.</span>
                    <form @submit.prevent="submit">
                        <div class="mb-4 flex items-center gap-4">
                            <label for="name" class="w-28 font-semibold">Nome</label>
                            <Input id="name" type="text" placeholder="Digite o nome do aluno" v-model="form.name" required />
                        </div>

                        <div class="mb-4 flex items-center gap-4">
                            <label for="calories" class="w-28 font-semibold">Email</label>
                            <Input id="calories" type="text" placeholder="Digite o e-mail" required v-model="form.email" />
                        </div>

                        <div class="mb-4 flex items-center gap-4">
                            <label for="protein" class="w-28 font-semibold">Senha</label>
                            <Input id="protein" type="password" autocomplete="none" placeholder="Digite a senha" required v-model="form.password" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mb-4 flex items-center gap-4">
                            <label for="protein" class="w-28 font-semibold">Confirmação</label>
                            <Input
                                id="protein"
                                type="password"
                                autocomplete="none"
                                placeholder="Confirme sua senha"
                                required
                                v-model="form.password_confirmation"
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="flex justify-end gap-2">
                            <Button type="button" label="Cancelar" severity="secondary" @click="visible = false"></Button>
                            <Button type="submit" label="Cadastrar"></Button>
                        </div>
                    </form>
                </Dialog>
            </div>
        </div>
    </AppLayout>
</template>
