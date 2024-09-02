<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';

interface Submission {
    id: string;
    month: string;
    submission: string;
    image?: string;
    created_at: string;
    updated_at: string;
}

const props = defineProps<{
    nickname?: string;
    username: string;
    avatar: string;
    submissions: Submission[];
}>();

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);

const open = ref(false);
</script>

<template>
    <div class="relative bg-white shadow overflow-hidden sm:rounded-lg">

        <!-- Count badge -->
        <div class="absolute top-1 right-2">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-sky-900 text-gray-100">
                {{ props.submissions.length }} / 12
            </span>
        </div>

        <!-- User info -->
        <div class="flex flex-row items-center px-4 py-5 sm:px-6">
            <img :src="props.avatar" alt="" class="h-16 w-16 rounded-full ring-1 ring-gray-900">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 whitespace-nowrap text-gray-900">{{ props.nickname ?? props.username }}</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ props.username }}</p>
            </div>
        </div>

        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5">
                    <button @click="open = !open" class="text-sm font-medium text-gray-500">
                        {{ open ? '- Hide' : '+ Show' }} Submissions
                    </button>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                        <ul
                            v-show="open"
                            role="list"
                            class="divide-ydivide-gray-200 rounded-md border border-gray-200"
                        >
                            <li v-for="submission in props.submissions" :key="submission.id" class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- <img :src="submission.image" alt="" class="flex-shrink-0 h-6 w-6 rounded-full"> -->
                                    <span class="ml-2 truncate">{{ submission.month }}</span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <p class="font-medium text-gray-900">{{ submission.submission }}</p>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</template>
