<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps<{
  title: string;
}>()

const meals = ref([
  {
    products: [
      { quantity: '', product: '', observation: '' }
    ]
  }
])

const addMeal = () => {
  meals.value.push({
    products: [
      { quantity: '', product: '', observation: '' }
    ]
  })
}

const addProduct = (mealIndex: number) => {
  meals.value[mealIndex].products.push({ quantity: '', product: '', observation: '' })
}

const removeProduct = (mealIndex: number, productIndex: number) => {
  meals.value[mealIndex].products.splice(productIndex, 1)
}

const submitForm = () => {
  router.post('/custom-diet', { meals: meals.value })

}
</script>

<template>
  <Head :title="title"/>
  <AppLayout>
    <div class="p-6 max-w-7xl mx-auto">
      <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ title }}</h1>

      <form class="space-y-4" @submit.prevent="submitForm">
        <div
          v-for="(meal, mealIndex) in meals"
          :key="mealIndex"
          class="bg-neutral-800 p-6 rounded-2xl shadow-md"
        >
          <h3 class="text-lime-400 text-xl font-bold mb-4">
            Refeição {{ mealIndex + 1 }}
          </h3>

          <div
            v-for="(product, productIndex) in meal.products"
            :key="productIndex"
            class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-4"
          >
            <div>
              <label class="block text-sm text-gray-300 mb-1">Quantidade</label>
              <input
                type="text"
                v-model="product.quantity"
                class="w-full bg-neutral-900 border border-neutral-700 text-white p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-500"
                placeholder="Ex: 3 fatias / 300 gramas"
              />
            </div>
            <div>
              <label class="block text-sm text-gray-300 mb-1">Produto</label>
              <input
                type="text"
                v-model="product.product"
                class="w-full bg-neutral-900 border border-neutral-700 text-white p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-500"
                placeholder="Ex: Pão francês"
              />
            </div>
            <div>
              <label class="block text-sm text-gray-300 mb-1">Observação</label>
              <input
                type="text"
                v-model="product.observation"
                class="w-full bg-neutral-900 border border-neutral-700 text-white p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-500"
                placeholder="Ex: Sem o miolo"
              />
            </div>
            <div class="flex flex-col items-center justify-center pt-2">
              <button
                v-if="productIndex === meal.products.length - 1"
                type="button"
                @click="addProduct(mealIndex)"
                class="bg-lime-500 text-white font-bold text-2xl w-9 h-9 rounded-full hover:bg-lime-400 transition cursor-pointer"
              >
                +
              </button>
              <button
                v-else
                type="button"
                @click="removeProduct(mealIndex, productIndex)"
                class="bg-red-500 text-white font-bold text-2xl w-9 h-9 rounded-full hover:bg-red-400 transition cursor-pointer"
              >
                ×
              </button>
            </div>
          </div>
        </div>

        <button
          type="button"
          @click="addMeal"
          class="w-full bg-lime-500 font-semibold py-2 px-4 rounded-xl hover:opacity-90 transition text-white cursor-pointer"
        >
          + Adicionar Refeição
        </button>
        <div class="mt-5">
          <button 
            type="submit"
            class="w-full bg-cyan-500 font-semibold py-2 px-4 rounded-xl hover:opacity-90 transition text-white cursor-pointer"
            >
            Criar Dieta
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
