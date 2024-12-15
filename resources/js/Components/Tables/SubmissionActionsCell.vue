<script setup lang="ts">
import type { Submission } from "@/types";
import TableBodyCell from "./TableBodyCell.vue";
import TableActions from "./TableActions.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps<{
    submission: Submission;
}>();

const emit = defineEmits<{
    delete: [Submission];
}>();
</script>

<template>
    <TableBodyCell class="flex justify-end items-center">
        <TableActions>
            <ul class="py-1 text-sm text-gray-700">
                <li>
                    <Link
                        :href="route('submissions.edit', submission.id)"
                        class="block py-2 px-4 hover:bg-gray-100"
                    >
                        Edit
                    </Link>
                </li>
            </ul>
            <div class="py-1">
                <button
                    @click="$emit('delete', submission)"
                    class="block py-2 px-4 w-full text-left text-red-500 hover:bg-gray-100"
                >
                    Delete
                </button>
            </div>
        </TableActions>
    </TableBodyCell>
</template>
