<script lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Home from '@/pages/templates/Home.vue';
import Navbar from './components/Navbar.vue';
export default {
    components: {
        Head,
        Link,
        Home,
        Navbar,
    }
}
</script>

<template>
    <Head title="Nutribase"/>
    <div>
        <Navbar/>
        <Home/>
    </div>
</template>