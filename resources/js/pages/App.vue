<script lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from './components/Navbar.vue';
import Home from '@/pages/templates/Home.vue';
import Features from './templates/Features.vue';
import Calculations from './templates/Calculations.vue';
export default {
    components: {
        Head,
        Link,
        Navbar,
        Home,
        Features,
        Calculations,
    }
}
</script>

<template>
    <Head title="Inicio"/>
    <div>
        <Navbar/>
        <Home/>
        <Features/>
        <Calculations/>
    </div>
</template>