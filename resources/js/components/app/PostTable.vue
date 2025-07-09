<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { onMounted, reactive, ref, toRaw } from 'vue';
import Vue3Datatable from '@bhplugin/vue3-datatable';
import '@bhplugin/vue3-datatable/dist/style.css';

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

// defineProps<{
//     posts: Array<{
//         id: number,
//         title: string,
//         body: string
//     }>
// }>()
onMounted(() => {
    getUsers();
});
const showDeleteModal = ref<boolean>(false)
const postId = ref<number | null>(null)
const loading = ref(true);
const total_rows = ref(0);
const params = reactive({
    current_page: 0,
    pagesize: 10,
    sort_column: 'id',
    sort_direction: 'desc',
    search: '',
    column_filters: [],
});
const rows: any = ref(null);
const cols =
    ref([
        { field: 'id', title: '#', isUnique: true, type: 'number' },
        { field: 'title', title: 'Title' },
        { field: 'body', title: 'Body' },
        { field: 'action', title: 'Action', sort: false },
    ]) || [];

// Filter Globally
let controller: any;
let timer: any;
const filterUsers = () => {
    clearTimeout(timer);
    timer = setTimeout(() => {
        getUsers();
    }, 300);
};


const getUsers = async () => {
    try {
        if (controller) controller.abort();
        controller = new AbortController();
        const signal = controller.signal;

        loading.value = true;
        const response = await fetch(route('post.data'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement)?.content || ''
            },
            body: JSON.stringify(toRaw(params)),
            signal
        });

        const data = await response.json();
        rows.value = data?.data;
        total_rows.value = data?.recordsFiltered || 0;
    } catch (error) {
        console.error('Error fetching posts:', error);

    } finally {
        loading.value = false;
    }
};


const changeServer = (data: any) => {
    params.current_page = (data.current_page - 1) * data.pagesize;
    params.pagesize = data.pagesize;
    params.column_filters = data.column_filters;
    params.search = data.search;
    if (data.sort_column !== 'action') {
        params.sort_column = data.sort_column;
        params.sort_direction = data.sort_direction;
    }
    if (data.change_type === 'search') {
        filterUsers();
    } else {
        getUsers();
    }
};

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
    <div class="w-full ">
        <h4 class="text-2xl font-semibold">Vue3 Datatable</h4>
    </div>
     
    <div class="w-full flex justify-between items-center">
        <input v-model="params.search" type="text"
            class="rounded-md border border-[#e0e6ed] bg-white px-4 py-2 text-sm font-semibold text-black !outline-none focus:border-primary focus:ring-transparent dark:border-[#17263c] dark:bg-[#121e32] dark:text-white-dark dark:focus:border-primary w-auto my-3"
            placeholder="Search..." />
        <Link :href="route('post.create')">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-1 px-3 rounded my-3 flex items-center gap-1 cursor-pointer">
            ➕ Create
        </button>
        </Link>
    </div>
    <div>
        <!-- Datatable -->
        <vue3-datatable :rows="rows" :columns="cols" :loading="loading" :totalRows="total_rows" :isServerMode="true"
            :pageSize="params.pagesize" :search="params.search" :pageSizeOptions="[7, 10, 20, 30, 50, 100, 'All']"
            :sortable="true" :sortColumn="params.sort_column" :sortDirection="params.sort_direction"
            @change="changeServer">
            <template #id="data">
                {{ data.value.keyCount }}
            </template>
            <template #action="data">
                <div class="flex items-center gap-5">
                    <Link :href="route('post.edit', data.value.id)">
                    <button
                        class="cursor-pointer">
                        ✏️ 
                    </button>
                    </Link>
                    <button @click="openDeleteModal(data.value.id)"
                        class=" cursor-pointer">
                        🗑️ 
                    </button>
                </div>
            </template>
        </vue3-datatable>
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
