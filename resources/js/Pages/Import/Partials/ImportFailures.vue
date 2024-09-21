<script setup lang="ts">
import { ImportFailure } from '@/types';

const props = defineProps<{
    failures: ImportFailure[];
}>();
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Import Failures</h2>

            <p class="mt-1 text-sm text-gray-600">
                Failures encountered during previous imports.
            </p>
        </header>

        <div class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Error
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Key
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Value
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="failure in props.failures"
                            :key="failure.id"
                            class="bg-white border-b hover:bg-gray-50"
                        >
                            <td class="px-6 py-4">
                                {{ failure.error }}
                            </td>
                            <td class="px-6 py-4">
                                {{ failure.key }}
                            </td>
                            <td class="px-6 py-4">
                                {{ failure.value }}
                            </td>
                            <td v-if="failure.contestant" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                <img class="w-10 h-10 rounded-full" :src="failure.contestant.avatar">
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ failure.contestant.username }}</div>
                                    <div class="font-normal text-gray-500">{{ failure.contestant.discord_id }}</div>
                                </div>
                            </td>
                            <td v-else>
                                <span class="text-gray-500">N/A</span>
                            </td>
                            <td class="px-6 py-4">
                                <button
                                    class="text-sm font-medium text-blue-600 hover:text-blue-900"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</template>
