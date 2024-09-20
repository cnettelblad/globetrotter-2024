<script setup lang="ts">
import { computed, ref } from 'vue';
import { Contestant } from '@/types';

const props = defineProps<{
    contestant: Contestant
}>();
</script>

<template>
    <div class="relative bg-white shadow overflow-hidden sm:rounded-lg">

        <!-- Count badge -->
        <div class="absolute top-1 right-2">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-sky-900 text-gray-100">
                {{ props.contestant.score }} / 12
            </span>
        </div>

        <!-- User info -->
        <div class="flex flex-row items-center px-4 py-5 sm:px-6">
            <img :src="props.contestant.avatar" alt="" class="h-16 w-16 my-4 rounded-full ring-1 ring-gray-900">
            <div class="px-4 py-5 sm:px-6 overflow-hidden">
                <h3 class="text-lg font-medium leading-6 whitespace-nowrap text-gray-900">{{ props.contestant.nickname ?? props.contestant.username }}</h3>
                <p v-if="props.contestant.nickname" class="mt-1 max-w-2xl text-sm text-gray-500">{{ props.contestant.username }}</p>
            </div>
        </div>
    </div>
</template>
