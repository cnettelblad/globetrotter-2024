<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ImportForm from '@/Pages/Import/Partials/ImportForm.vue';
import ImportFailures from './Partials/ImportFailures.vue';
import { ImportFailure } from '@/types';

const props = defineProps<{
    failures: ImportFailure[]
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Import</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <ImportForm />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <ImportFailures :failures="failures" />
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
