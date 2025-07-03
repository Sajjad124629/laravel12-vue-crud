<script setup lang="ts">
import PostTable from '@/components/app/PostTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
defineProps<{
    posts: Array<{
        id: number,
        title: string,
        body: string
    }>,
}>();
const breadcrumbs: BreadcrumbItem[] = [{ title: 'Post', href: '/post' }];

</script>

<template>

    <Head title="Post" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4  p-4">
            <PostTable :posts="posts" />
        </div>
    </AppLayout>
</template>
