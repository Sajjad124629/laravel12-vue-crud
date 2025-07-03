<script setup lang="ts">
defineProps({
    people: {
        type: Array as () => {
            id: number,
            name: string,
            email: string,
            phone: string,
            category: string,
        }[],
        required: true
    }
})
const categoryColor: { [key: string]: string } = {
    Works: 'bg-zinc-600 text-white',
    Family: 'bg-green-600 text-white',
    Friend: 'bg-yellow-600 text-white',
    Other: 'bg-red-600 text-white',
}
const getColor = (category: string) => categoryColor[category] || 'bg-gray-600 text-white'


</script>
<template>
    <div class="overflow-x-auto rounded-3xl">
        <div class="max-w-full overflow-hidden rounded-3xl shadow-lg border border-zinc-200 dark:border-zinc-500">
            <table class="w-full text-left border-collapse">
                <thead class="bg-zinc-400 text-white sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">#</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Name</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Email</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Phone Number</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Category</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800" v-for="(person, index) in people"
                        :key="person.id">
                        <td class="px-6 py-4 text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-800 dark:text-zinc-200">{{ person['name'] }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ person['email'] }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ person['phone'] }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 text-xs font-bold leading-5 uppercase rounded-full"
                                :class="getColor(person['category'])">
                                {{ person['category'] }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
