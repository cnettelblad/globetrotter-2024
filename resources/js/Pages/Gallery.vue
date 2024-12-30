<script setup lang="ts">
import { Submission } from "@/types";

const props = defineProps<{
    submissions: Submission[];
}>();
</script>

<template>
    <div v-for="submission in submissions" :key="submission.id">
        <img :src="submission.image" :alt="submission.month + ' submission'" />
    </div>
</template>
