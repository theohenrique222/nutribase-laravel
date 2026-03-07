<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps<{
    hasProfile: boolean;
}>();

const page = usePage();

const visible = ref(false);

onMounted(() => {
    if (!props.hasProfile) {
        visible.value = true;
    }
});
</script>

<template>
    <Dialog
        v-model:visible="visible"
        modal
        header="Perfil incompleto"
        :style="{ width: '40rem' }"
    >
        <p class="mb-4">Para utilizar esta funcionalidade você precisa completar seu perfil.</p>

        <Button type="button" label="Concluir cadastro" severity="success" @click="visible = false"></Button>
    </Dialog>
</template>
