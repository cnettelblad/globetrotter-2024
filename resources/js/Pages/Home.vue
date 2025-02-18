<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import SubmissionCard from "@/Components/Submission/SubmissionCard.vue";
import GalleryModal from "@/Components/Modals/GalleryModal.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import { computed, ref } from "vue";
import { Contestant, ResourceCollection, Submission } from "@/types";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { sortByMonthName } from "@/utils/sortByMonthName";

const props = defineProps<{
    contestants: ResourceCollection<Contestant>
}>();

const filteredContestants = computed(() => {
    if (!props.contestants.data) return [];
    if (!search.value) return props.contestants.data;

    const lcSearch = search.value.toLowerCase();

    return props.contestants.data.filter((contestant) => {
        if (contestant.nickname?.toLowerCase().includes(lcSearch)) return true;
        if (contestant.username?.toLowerCase().includes(lcSearch)) return true;
        if (contestant.discord_id?.toString().includes(lcSearch)) return true;
    });
});

const openGalleryModal = (contestant: Contestant, startSubmission?: Submission) => {
    if (!contestant.submissions) return;

    if (startSubmission) {
        const index = contestant.submissions.findIndex(
            (submission) => submission.id === startSubmission.id
        );

        if (index !== -1) {
            modalSubmissionsStart.value = index;
        }
    }

    modalContestant.value = contestant;
    showModal.value = true;
};

const showModal = ref(false);
const modalContestant = ref<Contestant | null>(null);
const modalSubmissionsStart = ref(0);
const search = ref("");
</script>

<template>
    <Head title="Submissions" />
    <div class="bg-gray-50">
        <div
            class="relative min-h-screen flex flex-col items-center"
        >
            <div class="relative w-full px-6 max-w-7xl">
                <header
                    class="py-2 text-center"
                >
                    <ApplicationLogo class="max-h-64 mx-auto" />
                </header>

                <main class="mt-2">
                    <div class="mb-6">
                        <TextInput
                            v-model="search"
                            placeholder="Search by nickname, username, or Discord ID"
                            class="w-full"
                        />
                    </div>

                    <div
                        class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 auto-rows-auto grid-flow-dense"
                    >
                        <SubmissionCard
                            v-for="contestant in filteredContestants"
                            :key="contestant.id"
                            :nickname="contestant.nickname"
                            :username="contestant.username"
                            :avatar="contestant.avatar"
                            :submissions="contestant.submissions"
                            @show-gallery="(submission) => openGalleryModal(contestant, submission)"
                        />
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black">
                    Built with
                    <a href="https://vuejs.org/" class="text-teal-600 font-bold"
                        >Vue</a
                    >,
                    <a
                        href="https://laravel.com/"
                        class="text-red-400 font-bold"
                        >Laravel</a
                    >
                    and
                    <a
                        href="https://tailwindcss.com/"
                        class="text-blue-600 font-bold"
                        >Tailwind CSS</a
                    >
                    for
                    <a
                        href="https://discord.gg/Xvv2vPFKwr"
                        class=" text-indigo-600 font-bold"
                        >Wanderlust</a>.
                </footer>
            </div>
        </div>
    </div>
    <GalleryModal
        v-if="showModal && modalContestant?.submissions"
        :submissions="modalContestant.submissions.sort((a, b) => sortByMonthName(a.month, b.month))"
        :start="modalSubmissionsStart"
        :title="modalContestant.nickname ?? modalContestant.username"
        @close="showModal = false"
    />
</template>
