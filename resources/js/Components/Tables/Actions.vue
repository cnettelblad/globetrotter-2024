<script setup lang="ts">
import { useOpen } from '@/use/useOpen';

const open = useOpen();
</script>

<template>
    <div class="relative">
        <button
            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
            type="button"
            @click="open = !open"
        >
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
            </svg>
        </button>
        <div v-show="open" class="fixed inset-0 z-10" @click="open = false"></div>
        <div
            class="absolute z-20 left-auto right-0 w-44 bg-white rounded divide-y divide-gray-100 shadow"
            v-show="open"
        >
            <slot />
        </div>
    </div>
</template>
