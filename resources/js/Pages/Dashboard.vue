<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AddSubmissionForm from "@/Pages/Contestants/AddSubmissionForm.vue";
import { Head } from "@inertiajs/vue3";
import ImportForm from "./Import/Partials/ImportForm.vue";
import Barplot from "@/Components/Charts/Barplot.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <AddSubmissionForm />
                </div>
            </div>
        </div>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Barplot />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
