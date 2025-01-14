<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Submission } from "@/types";

const props = defineProps<{
    submissions: Submission[];
}>();
</script>

<template>
    <Head title="Gallery" />
    <div class="w-full sm:max-w-md overflow-hidden sm:rounded-lg">
        <div class="w-full flex flex-1">
            <div v-for="submission in submissions" :key="submission.id">
                <img
                    class="w-16 rounded-md"
                    :src="submission.image"
                    :alt="submission.month + ' submission'"
                />
            </div>
        </div>
    </div>
</template>
