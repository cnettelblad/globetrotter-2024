<script setup lang="ts">
import type { Submission } from "@/types";
import { ref } from "vue";
import Table from "./Table.vue";
import TableHeader from "./TableHeader.vue";
import TableHeaderCell from "./TableHeaderCell.vue";
import TableRow from "./TableRow.vue";
import TableBodyCell from "./TableBodyCell.vue";
import ContestantCell from "./ContestantCell.vue";
import SubmissionActionsCell from "./SubmissionActionsCell.vue";
import SubmissionDeletionModal from "../Modals/SubmissionDeletionModal.vue";

const props = defineProps<{
    submissions: Submission[];
}>();

const deleteSubmission = ref<Submission | null>(null);
</script>

<template>
    <div class="overflow-x-auto">
        <Table>
            <template #header>
                <TableHeader>
                    <TableHeaderCell>Contestant</TableHeaderCell>
                    <TableHeaderCell>Month</TableHeaderCell>
                    <TableHeaderCell>Destination</TableHeaderCell>
                    <TableHeaderCell>Image</TableHeaderCell>
                    <TableHeaderCell>
                        <span class="sr-only">Actions</span>
                    </TableHeaderCell>
                </TableHeader>
            </template>

            <TableRow
                v-for="submission in submissions"
                :key="submission.id"
                class="border-b border-gray-200"
            >
                <ContestantCell
                    v-if="submission.contestant"
                    :contestant="submission.contestant"
                />
                <TableBodyCell>
                    {{ submission.month }}
                </TableBodyCell>
                <TableBodyCell>
                    {{ submission.destination?.name ?? "Unknown" }}
                </TableBodyCell>
                <TableBodyCell>
                    {{ submission.image ? "✅" : "❌" }}
                </TableBodyCell>
                <SubmissionActionsCell
                    :submission="submission"
                    @delete="deleteSubmission = submission"
                />
            </TableRow>
        </Table>
    </div>
    <Teleport to="body">
        <SubmissionDeletionModal
            v-if="deleteSubmission"
            :submission="deleteSubmission"
            @close="deleteSubmission = null"
        />
    </Teleport>
</template>
