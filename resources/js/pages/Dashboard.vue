<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
// import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import CategoryCard from '@/components/app/CategoryCard.vue';
import PeopleTable from '@/components/app/PeopleTable.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
// Directly access page.props and extract name
const page = usePage();
const people = page.props.people as {
    id: number,name: string, email: string, phone: string, category: string
}[];
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-4">
                <div class="relative  overflow-hidden rounded-3xl  dark:border-sidebar-border ">
                    <!-- <PlaceholderPattern /> -->
                    <CategoryCard category="Works" :people="people" />
                </div>
                <div class="relative  overflow-hidden rounded-xl  dark:border-sidebar-border">
                    <!-- <PlaceholderPattern /> -->
                    <CategoryCard category="Friend" :people="people" />
                </div>
                <div class="relative  overflow-hidden rounded-xl  dark:border-sidebar-border">
                    <!-- <PlaceholderPattern /> -->
                    <CategoryCard category="Family" :people="people" />
                </div>
                <div class="relative  overflow-hidden rounded-xl  dark:border-sidebar-border">
                    <!-- <PlaceholderPattern /> -->
                    <CategoryCard category="Other" :people="people" />
                </div>
                <!-- <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div> -->
            </div>
             <!-- <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
               
            </div> -->
            <PeopleTable  :people="people" />
        </div>
    </AppLayout>
</template>
