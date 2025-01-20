<script setup lang="ts">
import { Destination } from "@/types";
import Emoji from "@/Components/Emoji.vue";
import { PhotoIcon } from "@heroicons/vue/24/outline";

const props = defineProps<{
    month: string;
    destination: Destination | undefined;
}>();
</script>
<template>
    <li
        class="flex items-center justify-between py-4 pl-3 pr-4 text-sm relative group"
    >
        <span
            class="absolute text-gray-500 transform -translate-y-5 scale-75 top-2 z-10 origin-[0] bg-gray-50 px-2 peer-placeholder-shown:scale-100 start-1"
        >
            {{ month }}
        </span>
        <div class="px-4 flex-shrink-0 flex justify-between w-full gap-2 max-w-full font-medium">
            <p>
                <Emoji>{{ destination ? destination.emoji : "🏳️" }}</Emoji>
            </p>
            <p
                class="font-medium overflow-ellipsis whitespace-nowrap"
                :class="{
                    'text-gray-900': destination,
                    'text-gray-400': !destination
                }"
            >
                {{ destination ? destination.name : "-" }}
            </p>
            <p class="invisible group-hover:visible">
                <PhotoIcon class="h-5 w-5 text-green-800 inline-block" />
            </p>
        </div>
    </li>
</template>
