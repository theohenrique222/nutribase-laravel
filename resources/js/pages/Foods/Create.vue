<script setup lang="ts">
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{
    title?: string;
}>();

const form = useForm({
    name: '',
    calories: '',
    protein: '',
    carbs: '',
    fat: '',
});

const submit = () => {
    form.post(route('foods.store'));
};
</script>

<template>
    <Head :title="title" />

    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative flex-1 rounded-xl border">
                <div class="mx-auto max-w-xl p-6">
                    <h1 class="mb-6 text-2xl font-bold dark:text-white">
                        {{ title }}
                    </h1>

                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <Label for="name">Nome</Label>
                            <Input id="name" type="text" v-model="form.name" placeholder="Ex: Frango grelhado" required />
                        </div>

                        <div>
                            <Label for="calories">Calorias</Label>
                            <Input id="calories" type="number" step="0.01" v-model="form.calories" placeholder="Ex: 200" />
                        </div>

                        <div>
                            <Label for="protein">Proteína (g)</Label>
                            <Input id="protein" type="number" step="0.01" v-model="form.protein" placeholder="Ex: 30" />
                        </div>

                        <div>
                            <Label for="carbs">Carboidratos (g)</Label>
                            <Input id="carbs" type="number" step="0.01" v-model="form.carbs" placeholder="Ex: 15" />
                        </div>

                        <div>
                            <Label for="fat">Gordura (g)</Label>
                            <Input id="fat" type="number" step="0.01" v-model="form.fat" placeholder="Ex: 5" />
                        </div>

                        <Button type="submit" severity="success" class="w-full" label="Salvar alimento"/>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
