<script setup lang="ts">
import { toastStore } from "@/stores/toast";
import { Submission } from "@/types";
import { onMounted, onUnmounted } from "vue";

const props = defineProps<{
    submission: Submission;
}>();

const emit = defineEmits(["close"]);
const deleteSubmission = () => {
    emit("close");
    toastStore.addToast(`Submission ${props.submission.id} removed`);
};
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
                    <svg
                        class="mx-auto mb-4 text-gray-400 w-12 h-12"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 20 20"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                        />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                        Are you sure you want to delete this submission?
                    </h3>
                    <button
                        @click="deleteSubmission"
                        type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                    >
                        Yes, delete
                    </button>
                    <button
                        @click="cancel"
                        type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                    >
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-900/50 fixed inset-0 z-40"></div>
</template>
