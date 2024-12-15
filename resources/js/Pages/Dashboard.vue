<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AddSubmissionForm from "@/Pages/Contestants/Partials/AddSubmissionForm.vue";
import { Head } from "@inertiajs/vue3";
import CountriesBarplot from "@/Components/Charts/CountriesBarplot.vue";
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
                    <CountriesBarplot />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
