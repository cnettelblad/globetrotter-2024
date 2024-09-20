<script setup lang="ts">
import { onMounted, ref } from 'vue';

const model = defineModel<File | null>({ required: true });
const fileName = ref<string>('');
const props = defineProps<{
    accept?: string;
}>();

const handleFileSelection = async (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (!target.files) return;
    model.value = target.files[0];
}
</script>

<template>
    <input
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
        @change="handleFileSelection"
        ref="input"
        type="file"
        :accept="props.accept"
    />

    <p v-if="fileName">Selected file: {{ fileName }}</p>
</template>
