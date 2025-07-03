<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';


// defineProps({
//     posts:{
//         type: Array as () => {
//             id: number,
//             title: string,
//             body: string
//         }[],
//         required: true
//     }
// })

defineProps<{
    posts: Array<{
        id: number,
        title: string,
        body: string
    }>
}>()
const showDeleteModal = ref(false)
const postId = ref<number | null>(null)
const openDeleteModal = (id: number) => {
    postId.value = id
    showDeleteModal.value = true
}
const cancelDelete = () => {
    postId.value = null
    showDeleteModal.value = false
}
const confirmDelete = () => {
    deletePost(postId.value)
    showDeleteModal.value = false
}
// Direct Deleted
const deletePost = (id: number | null) => {
    if (!id) return alert('Post id not found')
    router.get(route('post.delete', id));
}
</script>
<template>
    <div class="w-full flex justify-end">
        <Link :href="route('post.create')">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-1 px-3 rounded my-3 flex items-center gap-1">
            ➕ Create
        </button>
        </Link>
    </div>
    <div class="overflow-x-auto rounded-3xl">
        <div class="max-w-full overflow-hidden rounded-3xl shadow-lg border border-zinc-200 dark:border-zinc-500">
            <table class="w-full text-left border-collapse">
                <thead class="bg-zinc-400 text-white sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">#</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Title</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">About</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800" v-for="(post, index) in posts" :key="post.id">

                        <td class="px-6 py-4 text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                            {{ post.title }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-600 dark:text-zinc-400">
                            {{ post.body }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-600 dark:text-zinc-400">
                            <Link :href="route('post.edit', post.id)">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-1 px-2 rounded inline-flex items-center gap-1">
                                ✏️ Edit
                            </button>
                            </Link>
                            <button @click="openDeleteModal(post.id)"
                                class="bg-red-500 hover:bg-red-700 text-white text-sm font-semibold py-1 px-2 rounded inline-flex items-center gap-1 ml-2">
                                🗑️ Delete
                            </button>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-md w-full max-w-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this post?</p>
            <div class="flex justify-end space-x-2">
                <button @click="cancelDelete"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1 px-4 rounded">
                    Cancel
                </button>
                <button @click="confirmDelete"
                    class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>
</template>
