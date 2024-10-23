<script setup lang="ts">
import { Contestant } from "@/types";
import { toastStore } from "@/stores/toast";
import DeletionConfirmation from "../Modals/ContestantDeletionModal.vue";
import { ref } from "vue";
import Table from "./Table.vue";
import TableHeader from "./TableHeader.vue";
import TableHeaderCell from "./TableHeaderCell.vue";
import TableRow from "./TableRow.vue";
import TableBodyCell from "./TableBodyCell.vue";
import ContestantCell from "./ContestantCell.vue";
import ContestantActionsCell from "./ContestantActionsCell.vue";

const props = defineProps<{
    contestants: Contestant[];
}>();

const deleteContestant = ref<Contestant | null>(null);
</script>

<template>
    <div class="overflow-x-auto">
        <Table>
            <template #header>
                <TableHeader>
                    <TableHeaderCell>Contestant</TableHeaderCell>
                    <TableHeaderCell>Submissions</TableHeaderCell>
                    <TableHeaderCell>
                        <span class="sr-only">Actions</span>
                    </TableHeaderCell>
                </TableHeader>
            </template>

            <TableRow
                v-for="contestant in contestants"
                :key="contestant.id"
                class="border-b border-gray-200"
            >
                <ContestantCell :contestant="contestant" />
                <TableBodyCell>
                    {{ contestant.score }}
                </TableBodyCell>
                <ContestantActionsCell
                    :contestant="contestant"
                    @delete="deleteContestant = contestant"
                />
            </TableRow>
        </Table>
    </div>
    <Teleport to="body">
        <DeletionConfirmation
            v-if="deleteContestant"
            :contestant="deleteContestant"
            @close="deleteContestant = null"
        />
    </Teleport>
</template>
