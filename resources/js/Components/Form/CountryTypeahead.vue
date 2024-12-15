<script setup lang="ts">
import type { Contestant, Destination } from "@/types";
import { onMounted, ref } from "vue";
import { router } from "@inertiajs/vue3";
import ContestantCard from "../Cards/ContestantCard.vue";
import { debounce } from "lodash";
import axios from "axios";
import Emoji from "../Emoji.vue";

interface TypeaheadProps {
    existingDestination?: Destination | undefined | null;
}
const { existingDestination = null } = defineProps<TypeaheadProps>();
const model = defineModel<string>();
const selectedDestination = ref<Destination | null>(null);
const input = ref<HTMLInputElement | null>(null);
const destinations = ref<Destination[]>([]);
const search = ref<string>();

onMounted(() => {
    if (input.value?.hasAttribute("autofocus")) {
        input.value?.focus();
    }

    if (existingDestination) {
        setDestination(existingDestination);
    }
});

const handleInput = debounce(() => {
    selectedDestination.value = null;

    if (!search.value || search.value.length < 2) {
        return;
    }

    axios
        .get(route("api.v1.destinations.index"), {
            params: {
                search: search.value,
                limit: 5,
            },
        })
        .then((response) => {
            if (response.data && response.data.data) {
                destinations.value = response.data.data;
            }
            console.log(response.data.data);
        });
}, 200);

const setDestination = (destination: Destination | null) => {
    selectedDestination.value = destination;
    model.value = destination?.id;
    search.value = destination?.name;
    destinations.value = [];
};

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <div class="relative">
        <div class="absolute grid place-items-center ps-3 inset-y-0 start-0">
            {{ selectedDestination ? selectedDestination.emoji : "🏳️" }}
        </div>
        <input
            type="text"
            ref="input"
            v-model="search"
            @input="handleInput"
            class="border-gray-300 ps-10 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            :class="$attrs.class"
            :placeholder="$attrs.placeholder as string || 'Begin typing to search...'"
        />
        <ul
            v-if="destinations.length"
            class="absolute left-0 right-0 mt-1 overflow-hidden shadow-lg border rounded-lg z-10"
        >
            <li
                v-for="destination in destinations"
                :key="destination.id"
                @click="setDestination(destination)"
                class="flex flex-row items-center gap-4 border-b border-gray-200 bg-white hover:bg-gray-50 cursor-pointer py-4 px-5"
            >
                <h4 class="text-gray-900 text-lg">
                    <Emoji>{{ destination.emoji }}</Emoji>
                    {{ destination.name }}
                    <span v-if="destination.code"
                        >({{ destination.code }})</span
                    >
                </h4>
            </li>
        </ul>
    </div>
</template>
