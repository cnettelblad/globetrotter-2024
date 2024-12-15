<script setup lang="ts">
import { onMounted, onUnmounted } from "vue";

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
        class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button
                    @click="cancel"
                    type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="popup-modal"
                >
                    <svg
                        class="w-3 h-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                    </svg>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <slot />
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-900/50 fixed inset-0 z-40"></div>
</template>
