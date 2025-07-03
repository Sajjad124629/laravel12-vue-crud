<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { usePage } from '@inertiajs/vue3';
import {watchEffect } from 'vue';
import { toast } from 'vue3-toastify';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

let shownMessage: string | null = null;
watchEffect(() => {
    const flash = usePage().props.flash as {
        message?: string;
        description?: string;
        alertType?: 'success' | 'error' | 'info';
    };
    if (flash.message && flash.message !== shownMessage) {
        toast(flash.message, {
            type: flash.alertType || 'info',
            autoClose: 2000,
        });
        shownMessage = flash.message;
    }
});

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
</template>
