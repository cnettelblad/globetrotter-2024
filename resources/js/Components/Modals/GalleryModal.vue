<script setup lang="ts">
import { Submission } from "@/types";
import { ChevronLeftIcon, ChevronRightIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { computed, nextTick, onMounted, onUnmounted, ref } from "vue";

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

const remainingHeight = ref("100vh"); // Default to full viewport height.

const recalculateHeight = () => {
    const header = document.getElementById("gallery-header")?.clientHeight || 0;
    const footer = document.getElementById("gallery-footer")?.clientHeight || 0;
    remainingHeight.value = `calc(100vh - ${header + footer}px)`;
};

onMounted(() => {
    document.addEventListener("keydown", handleKeyEvents);
    // window.addEventListener("resize", recalculateHeight);

    nextTick(() => recalculateHeight());

    document.body.style.overflow = "hidden";
});
onUnmounted(() => {
    document.removeEventListener("keydown", handleKeyEvents)
    document.body.style.overflow = "";
});
</script>

<template>
    <div
        class="flex flex-col overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-screen"
    >
        <div class="grid w-full" id="gallery-header">
            <button
                class="text-gray-200 place-self-end"
                @click="cancel"
                aria-label="Close"
            >
                <XMarkIcon class="w-16 h-16" />
            </button>
        </div>
        <div
            class="flex w-full h-full justify-between"
        >
            <button
                class="text-white py-32 px-4 hover:bg-black/50"
                @click="prevImage"
            >
                <ChevronLeftIcon class="h-12 w-12" />
            </button>

            <div class="w-full h-full grid place-items-center">
                <img
                    :src="props.submissions[currentImage].image"
                    :alt="props.submissions[currentImage].destination?.name"
                    class="max-w-full p-4"
                    :style="{ maxHeight: remainingHeight }"
                />
            </div>

            <button
                class="text-white py-32 px-4 hover:bg-black/50"
                @click="nextImage"
            >
                <ChevronRightIcon class="h-12 w-12" />
            </button>
        </div>
        <div id="gallery-footer">
            <div class="flex gap-8 align-middle items-center overflow-hidden relative left-0 right-0 py-4 bg-gray-800/50">
                <div
                    v-for="(submission, index) in props.submissions"
                    :key="index"
                    class="w-16 h-16 rounded-[2rem] overflow-hidden hover:rounded-2xl transition-[border-radius] duration-250 ease-in-out cursor-pointer border-gray-800 border-4"
                >
                    <img
                        :src="submission.image"
                        :alt="submission.destination?.name"
                        class="object-cover w-full h-full scale-125"
                        @click="currentImage = index"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-900/50 fixed inset-0 z-40"></div>
</template>
