import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import Button from "primevue/button"
import InputText from 'primevue/inputtext';
import 'primeicons/primeicons.css'
import Calculations from './pages/templates/Calculations.vue';
import Card from 'primevue/card';
import Dialog from 'primevue/dialog';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Row from 'primevue/row';
import ConfirmDialog from 'primevue/confirmdialog';
import ConfirmationService from 'primevue/confirmationservice';
import Galleria from 'primevue/galleria';

// Extend ImportMeta interface for Vite...

/// <reference types="vite/client" />

declare module 'vite/client' {
    declare interface ImportMetaEnv {
        readonly VITE_APP_NAME: string;
        [key: string]: string | boolean | undefined;
    }

    declare interface ImportMeta {
        readonly env: ImportMetaEnv;
        readonly glob: <T>(pattern: string) => Record<string, () => Promise<T>>;
    }
}

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(PrimeVue, {
                theme: {
                    preset: Aura,
                },
            })
            .use(plugin)
            .use(ZiggyVue)
            .use(ToastService)
            .use(PrimeVue)
            .use(ConfirmationService)
            .component('Button', Button)
            .component('Calculations', Calculations)
            .component('Card', Card)
            .component('Dialog', Dialog)
            .component('Toast', Toast)
            .component('ToastService', ToastService)
            .component('DataTable', DataTable)
            .component('Column', Column)
            .component('ColumnGroup', ColumnGroup)
            .component('Row', Row)
            .component('ConfirmDialog', ConfirmDialog)
            .component('ConfirmationService', ConfirmationService)
            .component('InputText', InputText)
            .component('Galleria', Galleria)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
