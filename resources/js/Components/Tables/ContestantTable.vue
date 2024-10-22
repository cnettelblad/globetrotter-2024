<script setup lang="ts">
import { Contestant } from '@/types';
import { Link } from '@inertiajs/vue3';
import Actions from './Actions.vue';
import { toastStore } from '@/stores/toast';
import DeletionConfirmation from '../Modals/DeletionConfirmation.vue';
import { ref } from 'vue';
import { useContestantFilter } from '@/use/useContestantFilter';

const props = defineProps<{
    contestants: Contestant[];
}>();

const copyDiscordId = (discordId: string) => {
    navigator.clipboard.writeText(discordId);
    toastStore.addToast('Copied Discord ID to clipboard');
};
const confirmDeletion = (contestant: Contestant) => {
    selectedContestant.value = contestant;
    showDeletionConfirmation.value = true;
};
const deleteContestant = () => {
    showDeletionConfirmation.value = false;
    selectedContestant.value = null;
    toastStore.addToast('Contestant removed');
};
const cancelDeletion = () => {
    showDeletionConfirmation.value = false;
    selectedContestant.value = null;
};
const showDeletionConfirmation = ref(false);
const selectedContestant = ref<Contestant | null>(null);
const search = ref('');
const { filter, filteredContestants } = useContestantFilter('', props.contestants);
</script>

<template>
    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input v-model="filter" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2" placeholder="Search" required>
                    </div>
                </form>
            </div>
            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <button type="button" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path>
                    </svg>
                    Add Contestant {{ search }}
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">
                            Contestant
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Submissions
                        </th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="contestant in filteredContestants"
                        :key="contestant.id"
                        class="border-b border-gray-200"
                    >
                        <td class="px-4 py-3 flex items-center gap-2">
                            <img :src="contestant.avatar" alt="Avatar" class="h-8 w-8 rounded-md">
                            <strong class="text-gray-900">{{ contestant.nickname ?? contestant.username }}</strong>
                            <span v-if="contestant.nickname" class="text-gray-500 text-xs">
                                {{ contestant.username }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            {{ contestant.score }}
                        </td>
                        <td class="px-4 py-3 flex items-center justify-end">
                            <Actions>
                                <ul class="py-1 text-sm text-gray-700">
                                    <li>
                                        <Link
                                            :href="route('contestants.edit', contestant.id)"
                                            class="block py-2 px-4 hover:bg-gray-100"
                                        >
                                            Edit
                                        </Link>
                                    </li>
                                    <li>
                                        <button
                                            @click="copyDiscordId(contestant.discord_id.toString())"
                                            class="block py-2 px-4 w-full text-left hover:bg-gray-100"
                                        >
                                            Copy Discord ID
                                        </button>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <button
                                        @click="confirmDeletion(contestant)"
                                        class="block py-2 px-4 w-full text-left text-red-500 hover:bg-gray-100"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </Actions>
                        </td>
                    </tr>
                </tbody>
            </table>
            <DeletionConfirmation
                v-if="showDeletionConfirmation && selectedContestant"
                :message="'Are you sure you want to remove ' + (selectedContestant.nickname ?? selectedContestant.username) + '?'"
                @confirm="deleteContestant"
                @cancel="cancelDeletion"
            />
        </div>
    </div>
</template>
