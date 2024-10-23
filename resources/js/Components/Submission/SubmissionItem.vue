<script setup lang="ts">
import { Destination } from "@/types";
import Emoji from "@/Components/Emoji.vue";

const props = defineProps<{
    month: string;
    destination: Destination | undefined;
}>();
</script>
<template>
    <li
        class="flex items-center justify-between py-4 pl-3 pr-4 text-sm relative"
    >
        <span
            class="absolute text-gray-500 transform -translate-y-5 scale-75 top-2 z-10 origin-[0] bg-gray-50 px-2 peer-placeholder-shown:scale-100 start-1"
        >
            {{ month }}
        </span>
        <div class="ml-4 flex-shrink-0">
            <p v-if="destination" class="font-medium text-gray-900">
                <Emoji>{{ destination.emoji }}</Emoji>
                {{ destination.name }}
            </p>
            <p v-else class="font-medium text-gray-400">
                <Emoji>🏳️</Emoji>
                -
            </p>
        </div>
    </li>
</template>
