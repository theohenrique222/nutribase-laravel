<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { LoaderCircle } from 'lucide-vue-next';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const { title } = defineProps<{
    title: string;
}>();
const submit = () => {
    form.post(route('students.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head :title="title" />
    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <div class="mx-auto max-w-7xl p-6 ">
                    <h1 class="mb-6 text-2xl font-bold dark:text-white">
                        {{ title }}
                    </h1>

                    <div class="flex h-full w-full items-center justify-center">
                        <form @submit.prevent="submit" class="flex flex-col gap-6 w-full px-10">
                            <div class="grid gap-6 space-y-2">
                                <div class="grid gap-2">
                                    <Label for="name">Nome</Label>
                                    <Input
                                        id="name"
                                        type="text"
                                        required
                                        autofocus
                                        :tabindex="1"
                                        autocomplete="name"
                                        v-model="form.name"
                                        placeholder="Nome completo"
                                    />
                                    <InputError :message="form.errors.name" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="email">Endereço de E-mail</Label>
                                    <Input
                                        id="email"
                                        type="email"
                                        required
                                        :tabindex="2"
                                        autocomplete="email"
                                        v-model="form.email"
                                        placeholder="email@nutribase.com"
                                    />
                                    <InputError :message="form.errors.email" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="password">Senha</Label>
                                    <Input
                                        id="password"
                                        type="password"
                                        required
                                        :tabindex="3"
                                        autocomplete="new-password"
                                        v-model="form.password"
                                        placeholder="Senha"
                                    />
                                    <InputError :message="form.errors.password" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="password_confirmation">Confirme sua senha</Label>
                                    <Input
                                        id="password_confirmation"
                                        type="password"
                                        required
                                        :tabindex="4"
                                        autocomplete="new-password"
                                        v-model="form.password_confirmation"
                                        placeholder="Confirme sua senha"
                                    />
                                    <InputError :message="form.errors.password_confirmation" />
                                </div>

                                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                    Criar Conta
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
