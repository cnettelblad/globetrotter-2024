<script setup lang="ts">
import { computed, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { Submission } from "@/types";
import SubmissionItem from "./SubmissionItem.vue";

const props = defineProps<{
    nickname?: string;
    username: string;
    avatar: string;
    submissions?: Submission[];
}>();

const months = [
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

const monthlySubmissions = computed(() => {
    return months.map((month) => {
        const entry = props.submissions?.find(
            (submission) => submission.month === month
        );
        return { month, submission: entry?.destination };
    });
});

const open = ref(false);
</script>

<template>
    <div class="transition" :class="open ? 'row-span-4' : null">
        <div class="relative bg-white shadow overflow-hidden sm:rounded-lg">
            <!-- Count badge -->
            <div class="absolute top-1 right-2">
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-sky-900 text-gray-100"
                >
                    {{ props.submissions?.length ?? 0 }} / 12
                </span>
            </div>

            <!-- User info -->
            <div class="flex flex-row items-center px-4 py-5 sm:px-6">
                <img
                    :src="props.avatar"
                    alt=""
                    class="h-16 w-16 my-4 rounded-full ring-1 ring-gray-900"
                />
                <div class="px-4 py-5 sm:px-6 overflow-hidden">
                    <h3
                        class="text-lg font-medium leading-6 truncate text-gray-900"
                    >
                        {{ props.nickname ?? props.username }}
                    </h3>
                    <p
                        v-if="props.nickname"
                        class="mt-1 max-w-2xl text-sm text-gray-500 truncate"
                    >
                        {{ props.username }}
                    </p>
                </div>
            </div>

            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50" :class="open ? 'pb-4' : null">
                        <button
                            @click="open = !open"
                            class="text-sm font-medium w-full py-5 text-gray-500"
                        >
                            {{ open ? "- Hide" : "+ Show" }} Submissions
                        </button>
                        <dd class="text-sm text-gray-900 sm:col-span-2">
                            <ul
                                v-show="open"
                                role="list"
                                class="divide-y divide-gray-200 rounded-md border border-gray-200 mx-4"
                            >
                                <SubmissionItem
                                    v-for="monthSubmission in monthlySubmissions"
                                    :month="monthSubmission.month"
                                    :destination="monthSubmission?.submission"
                                    :key="monthSubmission.month"
                                />
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</template>
