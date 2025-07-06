<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, Link } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Post-Create',
        href: '/post-create',
    },
];

const form = useForm({
    title: '',
    body: '',
})


const createPost = () => {
    form.post(route('post.store'));
}
</script>

<template>

    <Head title="Post Create" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Post</h2>
            <div class="py-12">
                <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">

                            <!-- Back Button -->
                            <Link :href="route('post.index')">
                            <button
                                class="bg-gray-500 hover:bg-gray-700 text-white text-sm font-semibold py-1 px-3 rounded inline-flex items-center gap-1 mb-4 cursor-pointer">
                                🔙 Back
                            </button>
                            </Link>

                            <!-- Post Form -->
                            <form @submit.prevent="createPost">
                                <div class="mb-4">
                                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                    <input id="title" v-model="form.title" type="text" placeholder="Enter Title" required
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                    <div class="text-red-500 text-sm mt-1"></div>
                                </div>

                                <div class="mb-4">
                                    <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body:</label>
                                    <textarea id="body" v-model="form.body" placeholder="Enter Body" required
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                    <div class="text-red-500 text-sm mt-1"></div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded inline-flex items-center gap-1 cursor-pointer"
                                    :disabled="form.processing">
                                     Submit
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
