<script lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from './components/Navbar.vue';
import Home from '@/pages/templates/Home.vue';
import Features from './templates/Features.vue';
export default {
    components: {
        Head,
        Link,
        Navbar,
        Home,
        Features,
    }
}
</script>

<template>
    <Head title="Nutribase"/>
    <div>
        <Navbar/>
        <Home/>
        <Features/>
    </div>
</template>