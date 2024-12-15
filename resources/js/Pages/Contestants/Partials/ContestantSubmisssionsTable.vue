<script setup lang="ts">
import { Contestant, Submission } from "@/types";
import { toastStore } from "@/stores/toast";
import { computed, ref } from "vue";
import Table from "@/Components/Tables/Table.vue";
import TableHeader from "@/Components/Tables/TableHeader.vue";
import TableHeaderCell from "@/Components/Tables/TableHeaderCell.vue";
import TableRow from "@/Components/Tables/TableRow.vue";
import TableBodyCell from "@/Components/Tables/TableBodyCell.vue";
import SubmissionActionsCell from "@/Components/Tables/SubmissionActionsCell.vue";
import GradientButton from "@/Components/Buttons/GradientButton.vue";
import GenericModal from "@/Components/Modals/GenericModal.vue";
import EditSubmissionForm from "./EditSubmissionForm.vue";

const props = defineProps<{
    submissions: Submission[];
}>();

const months = computed(() => {
    let months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    return months.map((month) => {
        const entry = props.submissions?.find(
            (submission) => submission.month === month
        );
        return { name: month, submission: entry };
    });
});
const editSubmission = ref<Submission | null>(null);
const deleteContestant = ref<Contestant | null>(null);
</script>

<template>
    <div class="overflow-x-auto">
        <Table>
            <template #header>
                <TableHeader>
                    <TableHeaderCell>Image</TableHeaderCell>
                    <TableHeaderCell>Month</TableHeaderCell>
                    <TableHeaderCell>Submission</TableHeaderCell>
                    <TableHeaderCell>
                        <span class="sr-only">Actions</span>
                    </TableHeaderCell>
                </TableHeader>
            </template>

            <TableRow
                v-for="month in months"
                :key="month.name"
                class="border-b border-gray-200"
                :class="{
                    'bg-gray-50': !month.submission,
                }"
            >
                <TableBodyCell>
                    <img
                        v-if="month.submission"
                        :src="
                            month.submission?.image
                                ? '/image.svg'
                                : '/no-image.svg'
                        "
                        alt="Submission image status"
                        class="w-8 h-8"
                        :class="{
                            'bg-red-100': !month.submission?.image,
                            'bg-green-100': month.submission?.image,
                        }"
                    />
                </TableBodyCell>
                <TableBodyCell :class="{ 'line-through': !month.submission }">
                    {{ month.name }}
                </TableBodyCell>
                <TableBodyCell>
                    {{ month.submission?.destination?.name ?? "No submission" }}
                </TableBodyCell>
                <SubmissionActionsCell
                    v-if="month.submission"
                    :submission="month.submission"
                    @edit="editSubmission = month.submission"
                />
                <TableBodyCell v-else />
            </TableRow>
        </Table>
    </div>
    <!-- <Teleport to="body">
        <DeletionConfirmation
            v-if="deleteContestant"
            :contestant="deleteContestant"
            @close="deleteContestant = null"
        />
    </Teleport> -->
    <Teleport to="body">
        <GenericModal v-if="editSubmission" @close="editSubmission = null">
            <EditSubmissionForm
                :submission="editSubmission"
                @success="editSubmission = null"
            />
        </GenericModal>
    </Teleport>
</template>
