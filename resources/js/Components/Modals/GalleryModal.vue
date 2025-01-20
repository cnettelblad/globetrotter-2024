<script setup lang="ts">
import { Submission } from "@/types";
import { ChevronLeftIcon, ChevronRightIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { onMounted, onUnmounted, ref } from "vue";

const props = defineProps<{
    submissions: Submission[];
    start?: number;
}>();

const emit = defineEmits(["close"]);

const cancel = () => {
    emit("close");
};

const handleKeyEvents = (e: KeyboardEvent) => {
    switch (e.key) {
        case "Escape":
            cancel();
            break;
        case "ArrowLeft":
            prevImage();
            break;
        case "ArrowRight":
            nextImage();
            break;
    }
};

const currentImage = ref<number>(props.start ?? 0);

const prevImage = () => {
    currentImage.value =
        (currentImage.value - 1 + props.submissions.length) % props.submissions.length;
};

const nextImage = () => {
    currentImage.value = (currentImage.value + 1) % props.submissions.length;
};

onMounted(() => document.addEventListener("keydown", handleKeyEvents));
onUnmounted(() => document.removeEventListener("keydown", handleKeyEvents));
</script>

<template>
    <div
        class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-screen"
    >
        <div
            class="flex flex-col h-full max-h-screen items-center justify-center"
        >

            <button
                class="absolute top-4 right-4 text-gray-200"
                @click="cancel"
                aria-label="Close"
            >
                <XMarkIcon class="w-16 h-16" />
            </button>

            <button
                class="absolute left-0 top-1/2 transform -translate-y-1/2 text-white py-32 px-4 hover:bg-black/50"
                @click="prevImage"
            >
                <ChevronLeftIcon class="h-12 w-12" />
            </button>

            <div class="flex p-8 max-h-full justify-center">
                <img
                    :src="props.submissions[currentImage].image"
                    :alt="props.submissions[currentImage].destination?.name"
                    class="max-w-full max-h-[80vh]"
                />
            </div>

            <button
                class="absolute right-0 top-1/2 transform -translate-y-1/2 text-white py-32 px-4 hover:bg-black/50"
                @click="nextImage"
            >
                <ChevronRightIcon class="h-12 w-12" />
            </button>

            <div class="flex gap-8 align-middle items-center overflow-hidden relative left-0 right-0">
                <div
                    v-for="(submission, index) in props.submissions"
                    :key="index"
                    class="p-1 bg-white min-w-16"
                >
                    <img
                        :src="submission.image"
                        :alt="submission.destination?.name"
                        class="w-16 max-h-full"
                        @click="currentImage = index"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-900/50 fixed inset-0 z-40"></div>
</template>
