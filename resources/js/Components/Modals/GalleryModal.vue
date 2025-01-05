<script setup lang="ts">
import { onMounted, onUnmounted } from "vue";

type Image = {
    url: string;
    description: string;
};

const props = defineProps<{
    images: Image[];
}>();

const emit = defineEmits(["close"]);

const cancel = () => {
    emit("close");
};

const cancelOnEscape = (e: KeyboardEvent) => {
    if (e.key === "Escape") {
        cancel();
    }
};

onMounted(() => document.addEventListener("keydown", cancelOnEscape));
onUnmounted(() => document.removeEventListener("keydown", cancelOnEscape));
</script>
<template>
    <div
        class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-screen"
    >
        <div
            class="flex flex-col h-full max-h-screen items-center justify-center"
        >
            <div class="flex p-8 max-h-full justify-center">
                <img
                    :src="props.images[0].url"
                    :alt="props.images[0].description"
                    class="max-w-full max-h-[90vh]"
                />
            </div>
            <div class="flex gap-8 align-middle items-center">
                <div
                    v-for="(image, index) in props.images"
                    :key="index"
                    class="p-1 bg-white"
                >
                    <img
                        :src="image.url"
                        :alt="image.description"
                        class="w-16 max-h-full"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-900/50 fixed inset-0 z-40"></div>
</template>
