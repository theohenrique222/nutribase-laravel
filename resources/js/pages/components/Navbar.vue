<template>
    <nav class="backdrop-blur-sm w-full border-b border-b-neutral-100/20 z-50 fixed top-0 bg-neutral-900/10">
        <div
            class="flex flex-row justify-between lg:max-w-6xl md:max-w-3xl sm:max-w-xl max-w-xs m-auto px-2 sm:px-3 lg:py-5 py-3 items-center">
            <div class="">
                <ul class="items-center space-x-4 text-neutral-100 font-bold lg:text-3xl text-2xl">
                    <li>
                        <a href="/">
                            Nutribase
                        </a>
                    </li>
                </ul>
            </div>

            <button @click="toggleMenu" class="lg:hidden flex text-neutral-100 text-3xl">
                <ion-icon :name="menuOpen ? 'close' : 'menu'" class="transition-all"></ion-icon>
            </button>
            <div class="">
                <ul class="hidden lg:flex items-center space-x-6 text-neutral-100">
                    <li v-for="item in items_menu" :key="item.id">
                        <a :href="item.href" class="py-5 transition-all hover:border-b-4 border-neutral-200 text-sm">
                            {{ item.name }}
                        </a>
                    </li>
                </ul>
            </div>

            <ul class="hidden lg:flex items-center space-x-6">
                <li v-for="social in social_icons" :key="social.id">
                    <a :href="social.href"
                        class="flex hover:-translate-y-1 transition-all">
                        <i :class="social.class" class="bg-neutral-100 text-sm p-2 rounded-full text-neutral-700 hover:bg-neutral-700 hover:text-neutral-100"></i>

                    </a>
                </li>
            </ul>
        </div>

        <div v-if="menuOpen"
            class="lg:hidden absolute top-16 left-0 w-full bg-neutral-800/80 backdrop-blur-sm p-5 flex flex-col items-center space-y-4 text-neutral-100 transition-all duration-300">

            <ul class="w-full text-center">
                <li v-for="item in items_menu" :key="item.id" class="border-b border-neutral-500 w-full p-2">
                    <a :href="item.href" class="block py-2 text-lg">{{ item.name }}</a>
                </li>
            </ul>

            <div class="flex space-x-4 p-2">
                <ul class="flex space-x-4">
                    <li v-for="social in social_icons" :key="social.id">
                        <a :href="social.href"
                            class="flex text-xl p-2 rounded-full bg-neutral-100 text-neutral-900 font-extrabold hover:bg-neutral-700 hover:text-neutral-100 transition-all">
                            <i :class="social.class" class="bg-neutral-100 text-sm p-2 rounded-full text-neutral-700 hover:bg-neutral-700 hover:text-neutral-100"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script lang="ts">
export default {
    name: "Navbar",
    data() {
        return {
            menuOpen: false,
            items_menu: [
                {
                    id: 1,
                    name: "Início",
                    href: '#hero'
                },
                {
                    id: 2,
                    name: "Funcionalidades",
                    href: '#features'
                },
                {
                    id: 3,
                    name: "Calculadora",
                    href: '#calculations'
                },
                {
                    id: 4,
                    name: "Contate-me",
                    href: '/macronutrients'
                },
            ],
            social_icons: [
                {
                    id: 1,
                    name: 'logo-instagram',
                    href: '/instagram',
                    class: 'pi pi-instagram'
                },
                {
                    id: 2,
                    name: 'logo-whatsapp',
                    href: '',
                    class: 'pi pi-whatsapp'
                },
                {
                    id: 3,
                    name: 'logo-twitter',
                    href: '',
                    class: 'pi pi-twitter'
                },
            ]
        };
    },
    methods: {
        toggleMenu() {
            this.menuOpen = !this.menuOpen;
            console.log("Menu aberto?", this.menuOpen);
        }
    }
};
</script>