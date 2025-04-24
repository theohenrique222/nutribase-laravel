<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{ title?: string }>();

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Nova medida', href: '/personal-datas' },
];

const formFields = [
  { label: "Idade", name: "age", type: "number", required: true },
  { label: "Altura (cm)", name: "height", type: "number", step: "0.01", required: true },
  { label: "Peso (kg)", name: "weight", type: "number", step: "0.01", required: true },
  { label: "Braço Esquerdo (cm)", name: "arm_l", type: "number", step: "0.01" },
  { label: "Braço Direito (cm)", name: "arm_r", type: "number", step: "0.01" },
  { label: "Peitoral (cm)", name: "chest", type: "number", step: "0.01" },
  { label: "Cintura (cm)", name: "waist", type: "number", step: "0.01" },
  { label: "Pescoço (Scruff) (cm)", name: "scruff", type: "number", step: "0.01" },
  { label: "Coxa Esquerda (cm)", name: "thigh_l", type: "number", step: "0.01" },
  { label: "Coxa Direita (cm)", name: "thigh_r", type: "number", step: "0.01" },
  { label: "Panturrilha (cm)", name: "calf", type: "number", step: "0.01" },
];

// ⬇️ Cria o formulário reativo
const form = useForm({
  age: '',
  height: '',
  weight: '',
  arm_l: '',
  arm_r: '',
  chest: '',
  waist: '',
  scruff: '',
  thigh_l: '',
  thigh_r: '',
  calf: ''
});

// ⬇️ Função para enviar
function submit() {
  form.post(route('personal-datas.store'));
}
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

          <div class="w-full h-full flex items-center justify-center">
            <form @submit.prevent="submit"
              class="w-full max-w-4xl dark:bg-neutral-900 bg-neutral-100 p-8 rounded-2xl shadow-xl grid grid-cols-1 md:grid-cols-2 gap-6">
              <div v-for="(field, index) in formFields" :key="index">
                <label :for="field.name" class="text-sm font-semibold dark:text-gray-50 mb-1 block">
                  {{ field.label }}
                </label>
                <input
                  :type="field.type"
                  :name="field.name"
                  :step="field.step"
                  v-model="form[field.name]"
                  :required="field.required"
                  class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
              </div>

              <div class="col-span-1 md:col-span-2 mt-4">
                <button type="submit"
                  class="w-full bg-lime-500 cursor-pointer text-white py-3 rounded-md font-semibold hover:opacity-90 transition duration-200">
                  Salvar Medidas
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
