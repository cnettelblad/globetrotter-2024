<script setup lang="ts">
import { defineProps, defineEmits } from "vue";
import { Contestant, Submission } from "@/types";
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Table from "@/Components/Tables/Table.vue";
import TableHeader from "@/Components/Tables/TableHeader.vue";
import SubmissionsTable from "@/Components/Tables/SubmissionsTable.vue";

defineProps<{
    submissions: Submission[];
}>();

defineEmits(["select"]);

const input = ref<HTMLInputElement | null>(null);
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contestants
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- List of contestants -->
                <div
                    class="relative bg-white overflow-x-auto shadow-md sm:rounded-lg"
                >
                    <SubmissionsTable :submissions="submissions" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
