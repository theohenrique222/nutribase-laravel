<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { Head, router } from "@inertiajs/vue3";

defineProps<{ title: string; calculations: Array }>();
</script>
<template>
  <Head :title="title" />
  <AppLayout>
    <div class="p-6 max-w-7xl mx-auto">
      <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ title }}</h1>
      <div class="flex">
        <p
          v-if="diet"
          class="text-white bg-neutral-800 p-4 rounded-lg mt-6 whitespace-pre-wrap"
        >
          {{ diet }}
        </p>
        <p class="py-2">Nenhum plano de alimentar cadastrado.</p>
      </div>
      <div class="bg-lime-500 w-1/5 text-center py-3 m-auto mt-10">
        <a href="diet-plan/create" class="text-white text-xl font-bold"> Monte Agora! </a>
      </div>
    </div>
  </AppLayout>
</template>
