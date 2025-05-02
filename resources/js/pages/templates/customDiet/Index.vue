<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps<{
  title: string;
}>();
</script>
<template>
  <Head :title="title" />
  <AppLayout>
    <div class="p-6 max-w-7xl mx-auto">
      <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ title }}</h1>
      <div class="bg-neutral-900 p-6 rounded-xl shadow-lg">
        <p
          v-if="diet"
          class="text-white whitespace-pre-wrap bg-neutral-800 p-6 rounded-lg"
        >
          {{ diet }}
        </p>

        <p v-else class="text-white text-lg">
          Nenhum plano alimentar montado no momento.
        </p>
      </div>

      <div
        class="bg-lime-500 w-fit text-center py-3 px-8 m-auto mt-10 rounded-md hover:opacity-80 transition"
      >
        <a href="/diet-plan/create" class="text-white text-xl font-bold">Monte Agora!</a>
      </div>
    </div>
  </AppLayout>
</template>
