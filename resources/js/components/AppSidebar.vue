<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, Home, Activity, Clipboard, LayoutDashboardIcon } from 'lucide-vue-next';

const mainNavItems: NavItem[] = [
    {
        title: 'Painel de controle',
        href: 'dashboard',
        icon: LayoutDashboardIcon,
    },
    {
        title: 'Medições',
        href: route('measurements.index'),
        icon: Clipboard,
    },
    {
        title: 'Coach',
        href: route('coach.index'),
        icon: Clipboard,
    },
    {
        title: 'Alunos',
        href: route('students.index'),
        icon: Clipboard,
    },
    {
        title: 'Analise Corporal',
        href: 'calculation',
        icon: Activity,
    },
    {
        title: 'Dieta IA',
        href: 'diet-plan',
        icon: Clipboard,
    },
    {
        title: 'Dieta personalizada',
        href: 'custom-diet',
        icon: Clipboard,
    },
    {
        title: 'Site',
        href: '/dashboard',
        icon: Home,
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
                            <NavUser />
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
