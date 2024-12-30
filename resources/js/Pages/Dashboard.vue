<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AddSubmissionForm from "@/Pages/Contestants/Partials/AddSubmissionForm.vue";
import { Head } from "@inertiajs/vue3";
import CountriesBarplot from "@/Components/Charts/CountriesBarplot.vue";

const props = defineProps<{
    unfinishedSubmissions: number;
    totalSubmissions: number;
    averageScore: number;
    monthlySubmissions: Record<string, number>;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">Dashboard</h2>
                <p class="mt-2 text-sm text-gray-500">
                    There are still {{ unfinishedSubmissions }} out of
                    {{ totalSubmissions }} submissions missing an image.
                </p>
                <p class="mt-2 text-sm text-gray-500">
                    The average score is {{ averageScore.toPrecision(1) }}.
                </p>
                <p class="mt-2 text-sm text-gray-500">
                    The number of submissions per month is as follows:
                </p>
                <ul class="mt-2 text-sm text-gray-500">
                    <li
                        v-for="(count, month) in monthlySubmissions"
                        :key="month"
                    >
                        {{ month }}: {{ count }}
                    </li>
                </ul>
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
