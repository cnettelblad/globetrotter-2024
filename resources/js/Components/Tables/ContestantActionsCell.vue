<script setup lang="ts">
import type { Contestant } from "@/types";
import TableBodyCell from "./TableBodyCell.vue";
import { toastStore } from "@/stores/toast";
import { ref } from "vue";
import TableActions from "./TableActions.vue";
import { Link } from "@inertiajs/vue3";
import DeletionConfirmation from "../Modals/ContestantDeletionModal.vue";

const props = defineProps<{
    contestant: Contestant;
}>();

const emit = defineEmits<{
    delete: [Contestant];
}>();

const copyDiscordId = (discordId: string) => {
    navigator.clipboard.writeText(discordId);
    toastStore.addToast("Copied Discord ID to clipboard");
};
</script>

<template>
    <TableBodyCell class="flex justify-end">
        <TableActions>
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
                    @click="$emit('delete', contestant)"
                    class="block py-2 px-4 w-full text-left text-red-500 hover:bg-gray-100"
                >
                    Delete
                </button>
            </div>
        </TableActions>
    </TableBodyCell>
</template>
