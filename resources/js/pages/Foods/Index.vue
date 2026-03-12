<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import ConfirmPopup from 'primevue/confirmpopup';
import { useConfirm } from 'primevue/useconfirm';
import { Input } from '@/components/ui/input';

defineProps<{
    title?: string;
    foods: any[];
}>();

const filters = ref({
    global: { value: null, matchMode: 'contains' },
});

const visible = ref(false);

const loading = ref(false);

const confirm = useConfirm();

function show(id: number) {
    router.visit(route('foods.show', id));
}

const editingId = ref<number | null>(null)

function edit(food: any) {
    editingId.value = food.id

    form.name = food.name
    form.calories = food.calories
    form.protein = food.protein
    form.carbs = food.carbs
    form.fat = food.fat

    visible.value = true
}

function destroy(event: Event, id: number) {
    confirm.require({
        target: event.currentTarget as HTMLElement,
        message: 'Tem certeza que deseja excluir este alimento?',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('foods.destroy', id), {
                onSuccess: () => {
                    alert('Alimento excluido em sucesso!')
                }
            });
        },
    });
}

const form = useForm({
    name: '',
    calories: '',
    protein: '',
    carbs: '',
    fat: '',
});

const submit = () => {

    if (editingId.value) {
        form.put(route('foods.update', editingId.value), {
            onSuccess: () => {
                alert('Alimento atualizado com sucesso!')
                visible.value = false
                form.reset()
                editingId.value = null
            }
        })
    }

    else {
        form.post(route('foods.store'), {
            onSuccess: () => {
                alert('Alimento cadastrado com sucesso');
                visible.value = false;
            },
        });
    }

};
</script>

<template>
    <Head :title="title" />
    <ConfirmPopup />
    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative flex-1 rounded-xl border">
                <div class="mx-auto max-w-7xl p-6">
                    <h1 class="mb-6 text-2xl font-bold dark:text-white">
                        {{ title }}
                    </h1>

                    <DataTable
                        v-model:filters="filters"
                        :value="foods"
                        paginator
                        :rows="10"
                        dataKey="id"
                        filterDisplay="row"
                        :loading="loading"
                        :globalFilterFields="['name', 'calories', 'protein', 'carbs']"
                    >
                        <template #header>
                            <div class="flex justify-end">
                                <IconField class="space-x-5">
                                    <InputIcon>
                                        <i class="pi pi-search" />
                                    </InputIcon>

                                    <InputText v-model="filters.global.value" placeholder="Buscar alimento" />
                                </IconField>
                            </div>
                        </template>

                        <template #empty> Nenhum alimento encontrado. </template>

                        <template #loading> Carregando alimentos... </template>

                        <!-- Nome -->
                        <Column field="name" header="Alimento" sortable>
                            <template #body="{ data }">
                                {{ data.name }}
                            </template>
                        </Column>

                        <!-- Calorias -->
                        <Column field="calories" header="Calorias" sortable>
                            <template #body="{ data }">
                                {{ data.calories }}
                            </template>
                        </Column>

                        <!-- Proteína -->
                        <Column field="protein" header="Proteína (g)" sortable>
                            <template #body="{ data }">
                                {{ data.protein }}
                            </template>
                        </Column>

                        <!-- Carboidrato -->
                        <Column field="carbs" header="Carboidrato (g)" sortable>
                            <template #body="{ data }">
                                {{ data.carbs }}
                            </template>
                        </Column>

                        <!-- Gorduras -->
                        <Column field="carbs" header="Gordura (g)" sortable>
                            <template #body="{ data }">
                                {{ data.fat }}
                            </template>
                        </Column>

                        <Column field="carbs" header="Ação" sortable>
                            <template #body="slotProps">
                                <div class="flex w-full justify-around">
                                    <Button icon="pi pi-eye" class="mr-2" @click="show(slotProps.data.id)" />
                                    <Button icon="pi pi-pencil" severity="warn" class="mr-2" @click="edit(slotProps.data)" />
                                    <Button icon="pi pi-trash" severity="danger" @click="destroy($event, slotProps.data.id)" />
                                </div>
                            </template>
                        </Column>
                    </DataTable>

                    <div class="m-auto mt-6 w-1/5">
                        <Button label="Cadastrar Alimento" @click="visible = true" class="w-full" />
                    </div>

                    <Dialog v-model:visible="visible" modal header="Cadastrar alimento" :style="{ width: '50rem' }" class="text-center">
                        <span class="text-surface-500 dark:text-surface-400 mb-8 block">Insira as informações sobre o alimento.</span>
                        <form @submit.prevent="submit">
                            <div class="mb-4 flex items-center gap-4">
                                <label for="name" class="w-28 font-semibold">Nome</label>
                                <Input id="name" type="text" placeholder="Ex: Frango grelhado" v-model="form.name" required />
                            </div>

                            <div class="mb-4 flex items-center gap-4">
                                <label for="calories" class="w-28 font-semibold">Calorias</label>
                                <Input id="calories" type="text" placeholder="Ex: 120" required v-model="form.calories" />
                            </div>

                            <div class="mb-4 flex items-center gap-4">
                                <label for="protein" class="w-28 font-semibold">Proteínas</label>
                                <Input id="protein" type="text" placeholder="Ex: 120" required v-model="form.protein" />
                            </div>

                            <div class="mb-4 flex items-center gap-4">
                                <label for="carbs" class="w-28 font-semibold">Carboidratos</label>
                                <Input id="carbs" type="text" placeholder="Ex: 120" required v-model="form.carbs" />
                            </div>

                            <div class="mb-4 flex items-center gap-4">
                                <label for="fat" class="w-28 font-semibold">Gordura</label>
                                <Input id="fat" type="text" placeholder="Ex: 120" required v-model="form.fat" />
                            </div>

                            <div class="flex justify-end gap-2">
                                <Button type="button" label="Cancelar" severity="secondary" @click="visible = false"></Button>
                                <Button type="button" label="Cadastrar" @click="submit"></Button>
                            </div>
                        </form>
                    </Dialog>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
