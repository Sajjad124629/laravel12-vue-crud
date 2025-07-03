<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    category: String,
    people: {
        type: Array as () => { category: string }[],
        required: true
    }
})
const totalPeople = computed(() => props.people.length)
const categoryPeople = computed(() => props.people.filter(p => p.category === props.category).length)
</script>
<template>
    <div class="relative bg-zinc-900 shadow-lg rounded-3xl overflow-hidden border border-zinc-800 cursor-pointer">
        <div class="absolute inset-0 bg-gradient-to-br from-zinc-900 to-black opacity-70 blur-sm"></div>
        <div class="relative z-10 p-8">
            <h1 class="text-2xl font-bold text-white mb-4 tracking-wide"></h1>
            <div class="flex flex-col gap-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-zinc-400">People In {{ category }} Category:</span>
                    <span class="text-xl font-bold text-zinc-200">{{ categoryPeople }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-zinc-400">Total People:</span>
                    <span class="text-xl font-bold text-zinc-100">{{ totalPeople }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-zinc-400">Total In Other Category People:</span>
                    <span class="text-xl font-bold text-zinc-100">{{ totalPeople - categoryPeople }}</span>
                </div>
            </div>
        </div>
    </div>
</template>