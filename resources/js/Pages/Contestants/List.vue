<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import { Contestant } from '@/types';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    contestants: Contestant[];
}>();

defineEmits(['select']);

const input = ref<HTMLInputElement | null>(null);
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contestants</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <!-- <input
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    ref="input"
                /> -->

                <!-- List of contestants -->
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="border-b border-gray-200 text-left px-6 py-3">Avatar</th>
                            <th class="border-b border-gray-200 text-left px-6 py-3">
                                Username
                            </th>
                            <th class="border-b border-gray-200 text-left px-6 py-3">Discord ID</th>
                            <th class="border-b border-gray-200 text-left px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="contestant in contestants"
                            :key="contestant.id"
                            @click="$emit('select', contestant)"
                            class="border-b border-gray-200 hover:bg-gray-50"
                        >
                            <td class="px-6 py-3">
                                <img
                                    :src="contestant.avatar"
                                    alt="Avatar"
                                    class="h-8 w-8 rounded-full"
                                />
                            </td>
                            <td class="px-6 py-3">{{ contestant.username }}</td>
                            <td class="px-6 py-3">{{ contestant.discord_id }}</td>
                            <td class="px-6 py-3">
                                <button
                                    @click="$emit('select', contestant)"
                                    class="text-indigo-600 hover:text-indigo-900 w-6 h-6"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button
                                    class="text-red-600 hover:text-red-900 w-6 h-6"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
