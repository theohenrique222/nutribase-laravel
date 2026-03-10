<script setup lang="ts">
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<{
    items: NavItem[];
}>();

const page = usePage<SharedData>();

const isCoach = page.props.isCoach as boolean;
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <div v-if="isCoach">
            <SidebarGroupLabel>Área do profissional</SidebarGroupLabel>
        </div>
        <div v-if="!isCoach">
            <SidebarGroupLabel>Área do aluno</SidebarGroupLabel>
        </div>
        <SidebarMenu>
            <SidebarMenuItem v-for="item in items.filter((i) => i.show !== false)" :key="item.title">
                <SidebarMenuButton as-child :is-active="item.href === page.url" :tooltip="item.title">
                    <Link :href="item.href">
                        <component :is="item.icon" />
                        <span>{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
