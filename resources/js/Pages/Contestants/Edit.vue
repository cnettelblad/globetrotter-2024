<script setup lang="ts">
import { defineProps, defineEmits } from "vue";
import { Contestant } from "@/types";
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import GradientButton from "@/Components/Buttons/GradientButton.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import InputError from "@/Components/Form/InputError.vue";
import InputLabel from "@/Components/Form/InputLabel.vue";
import ContestantSubmisssionsTable from "./Partials/ContestantSubmisssionsTable.vue";
import AddSubmissionForm from "./AddSubmissionForm.vue";

const props = defineProps<{
    contestant: Contestant;
}>();

const form = useForm({
    nickname: props.contestant.nickname ?? "",
});

const updateContestant = () => {
    form.put(route("contestants.update", props.contestant.id), {
        onSuccess: () => {
            form.reset();
        },
        replace: true,
        preserveScroll: true,
    });
};

const updateSubmission = () => {};

const submittable = ref(true);
const showAddForm = ref(false);
</script>

<template>
    <Head :title="`Editing ${contestant.username}`" />

    <AuthenticatedLayout>
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <h2 class="text-xl">Contestant</h2>
                <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="updateContestant" class="space-y-6">
                        <div>
                            <InputLabel for="nickname" value="Nickname" />
                            <TextInput
                                v-model="form.nickname"
                                id="nickname"
                                label="Nickname"
                                name="nickname"
                                class="mt-1 block w-full"
                                :error="form.errors.nickname"
                            />
                            <InputError :error="form.errors.nickname" />
                        </div>
                        <div class="columns-1 sm:columns-2">
                            <InputLabel for="username" value="Username" />
                            <TextInput
                                id="username"
                                label="username"
                                name="username"
                                class="mt-1 block w-full bg-gray-100 cursor-not-allowed"
                                v-model="contestant.username"
                                :disabled="true"
                            />
                            <InputLabel for="discord_id" value="Discord ID" />
                            <TextInput
                                id="discord_id"
                                label="discord_id"
                                name="discord_id"
                                class="mt-1 block w-full bg-gray-100 cursor-not-allowed"
                                v-model="contestant.discord_id"
                                :disabled="true"
                            />
                        </div>
                        <GradientButton :disabled="!submittable">
                            Update
                        </GradientButton>
                    </form>
                </section>

                <div class="flex justify-between items-center">
                    <h2 class="text-xl">Submissions</h2>
                    <GradientButton @click="showAddForm = !showAddForm">
                        Add Submission
                    </GradientButton>
                </div>

                <div
                    class="p-4 sm:p-8 bg-white shadow sm:rounded-lg"
                    v-if="showAddForm"
                >
                    <AddSubmissionForm
                        :contestant="contestant"
                        @close="showAddForm = false"
                    />
                </div>

                <div class="bg-white shadow sm:rounded-lg">
                    <ContestantSubmisssionsTable
                        :submissions="contestant.submissions ?? []"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
