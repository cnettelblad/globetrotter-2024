<script setup lang="ts">
import { CloudArrowDownIcon, TrashIcon } from "@heroicons/vue/24/outline";
import { onMounted, ref } from "vue";

interface FileInputProps {
    multiple?: boolean;
}

const model = defineModel<File | null>();
const URL = window.URL || window.webkitURL;
const { multiple = false } = defineProps<FileInputProps>();

const handleFileSelection = async (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (!target.files?.length) return;
    model.value = target.files[0];
};
</script>

<template>
    <div class="grid place-items-center w-full">
        <label
            for="dropzone-file"
            class="grid place-items-center relative w-full h-64 border-2 border-gray-300 border-dashed rounded-lg"
        >
            <input
                v-if="!model"
                id="dropzone-file"
                type="file"
                class="overlay cursor-pointer focus:outline-none"
                @change="handleFileSelection"
                accept=".jpg,.jpeg,.png"
                :multiple="multiple"
            />
            <div
                class="overlay grid place-items-center pt-5 pb-6 pointer-events-none cursor-pointer bg-gray-50"
            >
                <div
                    v-if="model"
                    class="relative rounded-lg bg-white shadow-lg p-2"
                >
                    <img
                        :src="URL.createObjectURL(model)"
                        alt="Image preview"
                        class="max-h-48 object-cover rounded-lg"
                    />
                    <button
                        type="button"
                        @click.prevent="model = null"
                        class="absolute top-4 right-4 p-2 shadow-md bg-white text-red-800 rounded-full pointer-events-auto"
                    >
                        <TrashIcon class="h-4 w-4" />
                    </button>
                </div>
                <div v-else class="flex flex-col items-center">
                    <CloudArrowDownIcon class="w-12 h-12 text-gray-400" />
                    <p class="mb-2 text-sm text-gray-500">
                        <span class="font-semibold">Click to upload</span>
                        or drag and drop
                    </p>
                    <p class="text-xs text-gray-500">
                        JPG, JPEG or PNG (MAX. 10MB)
                    </p>
                </div>
            </div>
        </label>
    </div>
</template>

<style lang="postcss" scoped>
.overlay {
    @apply absolute top-0 left-0 right-0 bottom-0 w-full;
}
</style>
