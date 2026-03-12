<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, Folder, Home, Activity, Clipboard, LayoutDashboardIcon } from 'lucide-vue-next';

const page = usePage();
const isCoach = page.props.isCoach as boolean;

const mainNavItems: NavItem[] = [
    {
        title: 'Painel de controle',
        href: route('dashboard'),
        icon: Home,
    },
    {
        title: 'Medições',
        href: route('measurements.index'),
        icon: Activity,
    },
    {
        title: 'Coach',
        href: route('coach.index'),
        icon: Clipboard,
        show: isCoach,
    },
    {
        title: 'Alunos',
        href: route('students.index'),
        icon: Clipboard,
        show: isCoach,
    },
    {
        title: 'Alimentos',
        href: route('foods.index'),
        icon: Clipboard,
        show: isCoach
    },
    // {
    //     title: 'Analise Corporal',
    //     href: 'calculation',
    //     icon: Activity,
    // },
    // {
    //     title: 'Dieta IA',
    //     href: 'diet-plan',
    //     icon: Clipboard,
    // },
    {
        title: 'Dieta',
        href: route('diet.index'),
        icon: Clipboard,
        show: !isCoach
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
