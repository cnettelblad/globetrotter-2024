<script setup lang="ts">
import { Contestant } from "@/types";
import { onMounted, ref, toRef } from "vue";
import ContestantCard from "../Cards/ContestantCard.vue";
import { useContestantFilter } from "@/use/useContestantFilter";

const model = defineModel<string>();
const selectedContestant = ref<Contestant | null>(null);
const input = ref<HTMLInputElement | null>(null);
const search = ref<string>("");

onMounted(() => {
    if (input.value?.hasAttribute("autofocus")) {
        input.value?.focus();
    }
});

const props = defineProps<{
    contestants: Contestant[];
    contestant: Contestant | undefined;
}>();

const handleInput = (event: Event) => {
    filter.value = (event.target as HTMLInputElement).value;
};

const handleSelection = (contestant: Contestant) => {
    model.value = contestant.id;
    selectedContestant.value = contestant;
    filter.value = "";
};

const clearSelection = () => {
    model.value = "";
    selectedContestant.value = null;
    filter.value = "";
};

const { filter, filteredContestants: filteredContestantsTwo } =
    useContestantFilter("", toRef(props, "contestants"));

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <div v-if="selectedContestant">
        <ContestantCard :contestant="selectedContestant" class="w-64" />
        <button
            @click="clearSelection"
            class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded"
        >
            Clear selection
        </button>
    </div>
    <div v-if="!selectedContestant" class="relative">
        <input
            type="text"
            ref="input"
            v-model="filter"
            @input="handleInput"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            :class="$attrs.class"
            :placeholder="$attrs.placeholder as string || 'Begin typing to search...'"
        />
        <ul
            v-if="filteredContestantsTwo && filter"
            class="absolute left-0 right-0 mt-1 overflow-hidden shadow-lg border rounded-lg z-10"
        >
            <li
                v-for="contestant in filteredContestantsTwo"
                :key="contestant.id"
                @click="handleSelection(contestant)"
                class="flex flex-row items-center gap-4 border-b border-gray-200 bg-white hover:bg-gray-50 cursor-pointer py-4 px-5"
            >
                <img
                    :src="contestant.avatar"
                    alt="Avatar"
                    class="h-8 w-8 rounded-full"
                />
                <div class="flex flex-col align-middle justify-center">
                    <div>
                        <span class="text-gray-900">
                            {{ contestant.nickname ?? contestant.username }}
                        </span>
                        <span
                            v-if="contestant.nickname"
                            class="text-gray-500 text-xs"
                        >
                            ({{ contestant.username }})
                        </span>
                    </div>
                    <span class="text-gray-500">{{
                        contestant.discord_id
                    }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>
