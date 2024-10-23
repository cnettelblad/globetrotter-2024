<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import { Contestant } from '@/types';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    contestant: Contestant;
}>();
</script>

<template>
    <Head :title="contestant.username" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ contestant.username }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ contestant.username }}s profile
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            <Link :href="route('contestants.index', contestant.id)">
                                Test
                            </Link>
                        </p>
                    </header>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div v-for="submission in contestant.submissions" :key="submission.id">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ submission.month }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ submission.destination?.name }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
