<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dieta', href: '/diet-plan' },
];

defineProps<{ title: string }>();

const goal = ref('');
const activity = ref('');
const selectedFoods = ref({
  proteins: [],
  carbs: [],
  salads: [],
  fats: []
});

async function submit() {
  try {
    const response = await axios.post('/api/generate-diet', {
      goal: goal.value,
      activity: activity.value,
      selectedFoods: selectedFoods.value,
    });

    console.log('Resposta da IA:', response.data);

    router.post('/diet-plan', {
      goal: goal.value,
      activity: activity.value,
      selectedFoods: selectedFoods.value,
      ai_result: response.data.choices[0].message.content,
    });

  } catch (error) {
    console.error('Erro ao gerar dieta:', error);
  }
}


</script>

<template>
  <Head :title="title" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="bg-neutral-900 relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min"
    >
      <div class="p-6 max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ title }}</h1>
        <div class="overflow-x-auto bg-white dark:bg-neutral-900 shadow-lg">
          <div
            class="bg-neutral-700 w-full max-w-5xl mx-auto min-h-screen rounded-2xl shadow-lg p-8"
          >
            <form @submit.prevent="submit">
              <h2 class="text-white text-2xl font-semibold mb-6 text-center">
                Selecione os alimentos que deseja incluir na sua dieta
              </h2>

              <div
                class="grid grid-cols-1 md:grid-cols-2 bg-neutral-800 p-5 rounded-xl text-center mb-2"
              >
                <div class="">
                  <h3 class="text-lime-400 text-xl font-bold mb-4">
                    Selecione seu objetivo
                  </h3>
                  <select v-model="goal" class="bg-neutral-700 p-2 rounded-md w-3/4">
                    <option value="" disabled>Selecione</option>
                    <option value="hypertrophy">Hipertrofia</option>
                    <option value="weight_loss">Perder gordura</option>
                    <option value="mass_gain">Ganho de massa</option>
                  </select>
                </div>
                <div>
                  <h3 class="text-lime-400 text-xl font-bold mb-4">
                    Selecione seu nível de atividade
                  </h3>
                  <select v-model="activity" class="bg-neutral-700 p-2 rounded-md w-3/4">
                    <option value="" disabled>Selecione</option>
                    <option value="active">Ativo</option>
                    <option value="moderate">Moderado</option>
                    <option value="sedentary">Sedentário</option>
                  </select>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                  class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow"
                >
                  <h3 class="text-lime-400 text-xl font-bold mb-4">Proteínas</h3>
                  <div class="space-y-2 text-white">
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="carne"
                        class="accent-lime-500"
                        v-model="selectedFoods.proteins"
                      />
                      Carne
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="frango"
                        class="accent-lime-500"
                        v-model="selectedFoods.proteins"
                      />
                      Frango
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="peixe"
                        class="accent-lime-500"
                        v-model="selectedFoods.proteins"
                      />
                      Peixe
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="ovo"
                        class="accent-lime-500"
                        v-model="selectedFoods.proteins"
                      />
                      Ovo
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="queijo"
                        class="accent-lime-500"
                        v-model="selectedFoods.proteins"
                      />
                      Queijo
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="whey protein"
                        class="accent-lime-500"
                        v-model="selectedFoods.proteins"
                      />
                      Whey protein
                    </label>
                  </div>
                </div>

                <div
                  class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow"
                >
                  <h3 class="text-lime-400 text-xl font-bold mb-4">Carboidratos</h3>
                  <div class="space-y-2 text-white">
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="arroz"
                        class="accent-lime-500"
                        v-model="selectedFoods.carbs"
                      />
                      Arroz
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        class="accent-lime-500"
                        value="macarrão"
                        v-model="selectedFoods.carbs"
                      />
                      Macarrão
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="feijão"
                        class="accent-lime-500"
                        v-model="selectedFoods.carbs"
                      />
                      Feijão
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="cuscuz"
                        class="accent-lime-500"
                        v-model="selectedFoods.carbs"
                      />
                      Cuscuz
                    </label>
                  </div>
                </div>

                <div
                  class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow"
                >
                  <h3 class="text-lime-400 text-xl font-bold mb-4">Saladas</h3>
                  <div class="space-y-2 text-white">
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        class="accent-lime-500"
                        value="alface"
                        v-model="selectedFoods.salads"
                      />
                      Alface
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="tomate"
                        class="accent-lime-500"
                        v-model="selectedFoods.salads"
                      />
                      Tomate
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="cenoura"
                        class="accent-lime-500"
                        v-model="selectedFoods.salads"
                      />
                      Cenoura
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="cebola"
                        class="accent-lime-500"
                        v-model="selectedFoods.salads"
                      />
                      Cebola
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="repolho"
                        class="accent-lime-500"
                        v-model="selectedFoods.salads"
                      />
                      Repolho
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="couve"
                        class="accent-lime-500"
                        v-model="selectedFoods.salads"
                      />
                      Couve
                    </label>
                  </div>
                </div>

                <div
                  class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow"
                >
                  <h3 class="text-lime-400 text-xl font-bold mb-4">Gorduras</h3>
                  <div class="space-y-2 text-white">
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="azeite"
                        class="accent-lime-500"
                        v-model="selectedFoods.fats"
                      />
                      Azeite
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="castanha"
                        class="accent-lime-500"
                        v-model="selectedFoods.fats"
                      />
                      Castanha
                    </label>
                    <label class="flex items-center gap-2">
                      <input
                        type="checkbox"
                        value="amendoim"
                        class="accent-lime-500"
                        v-model="selectedFoods.fats"
                      />
                      Amendoim
                    </label>
                  </div>
                </div>
              </div>
              <div class="mt-8 text-center">
                <button
                  type="submit"
                  class="bg-lime-500 hover:opacity-80 cursor-pointer text-white font-semibold px-8 py-3 rounded-md transition duration-200"
                >
                  Salvar Preferências
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
