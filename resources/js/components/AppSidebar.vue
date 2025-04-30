<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder,  Home, Activity, Clipboard, LayoutDashboardIcon } from 'lucide-vue-next';

const mainNavItems: NavItem[] = [
    {
        title: 'Inicio',
        href: '/',
        icon: Home,
    },
    // {
    //     title: 'Painel de controle',
    //     href: 'dashboard',
    //     icon: LayoutDashboardIcon,
    // },
    {
        title: 'Dados Pessoais',
        href: 'personal-datas',
        icon: Clipboard
    },
    {
        title: 'Analise Corporal',
        href: 'calculation',
        icon: Activity,
    },
    {
        title: 'Dieta',
        href: '/diet-plan',
        icon: Clipboard
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                        <NavUser/>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

    </Sidebar>
    <slot />
</template>
