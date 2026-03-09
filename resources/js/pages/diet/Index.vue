<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps<{
  title: string;
  diet: string | null;
}>();
</script>

<template>
  <Head :title="title" />
  <AppLayout>
      <div class="flex h-full flex-1 flex-col gap-4 rounded-xl">
          <div class="border-sidebar-border/70 dark:border-sidebar-border relative flex-1 rounded-xl border">
              <div class="mx-auto max-w-7xl p-6">
                  <h1 class="mb-6 text-2xl font-bold dark:text-white">
                      {{ title }}
                  </h1>
              </div>
          </div>
      </div>

      <div class="bg-lime-500 w-fit text-center py-3 px-8 m-auto mt-10 rounded-md hover:opacity-80 transition">
        <a href="/diet-plan/create" class="text-white text-xl font-bold">Monte Agora!</a>
      </div>

  </AppLayout>
</template>
