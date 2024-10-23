<script setup lang="ts">
import type { Contestant } from "@/types";
import TableBodyCell from "./TableBodyCell.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps<{
    contestant: Contestant;
}>();
</script>

<template>
    <TableBodyCell>
        <Link
            class="flex items-center gap-2"
            :href="route('contestants.edit', contestant.id)"
        >
            <img
                :src="contestant.avatar"
                alt="Avatar"
                class="h-8 w-8 rounded-md"
            />
            <strong class="text-gray-900">
                {{ contestant.nickname ?? contestant.username }}
            </strong>
            <span v-if="contestant.nickname" class="text-gray-500 text-xs">
                {{ contestant.username }}
            </span>
        </Link>
    </TableBodyCell>
</template>
