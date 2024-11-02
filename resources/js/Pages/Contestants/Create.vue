<script setup lang="ts">
import { defineProps, defineEmits, computed } from "vue";
import { Contestant } from "@/types";
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import GradientButton from "@/Components/Buttons/GradientButton.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import InputError from "@/Components/Form/InputError.vue";
import InputLabel from "@/Components/Form/InputLabel.vue";

const form = useForm({
    discord_id: "",
});

const submittable = computed(() => {
    console.log(isDiscordIdValid(form.discord_id) && !form.processing);
    return isDiscordIdValid(form.discord_id) && !form.processing;
});

const isDiscordIdValid = (discordId: string) => {
    return /^\d{17,19}$/.test(discordId);
};

const addSubmission = () => {
    form.post(route("contestants.store"), {
        onSuccess: () => {
            form.reset();
        },
    });
};

const validateDiscordId = () => {
    form.errors.discord_id = !isDiscordIdValid(form.discord_id)
        ? "Discord ID must be between 17 and 19 characters long and only contain numbers"
        : "";
};
</script>

<template>
    <Head title="Add new Contestant" />

    <AuthenticatedLayout>
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Import Contestant from Discord
                        </h2>
                        <form
                            @submit.prevent="addSubmission"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel
                                    for="discord-id"
                                    value="Discord ID"
                                />
                                <TextInput
                                    id="discord-id"
                                    v-model="form.discord_id"
                                    class="mt-1 block w-full"
                                    type="text"
                                    pattern="[0-9]*"
                                    @input="validateDiscordId"
                                    placeholder="123456789012345678"
                                    autocomplete="off"
                                />
                                <InputError
                                    :message="form.errors.discord_id"
                                    class="mt-2"
                                />
                            </div>

                            <div class="flex items-center gap-4">
                                <GradientButton :disabled="!submittable">
                                    Add
                                </GradientButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p
                                        v-if="form.recentlySuccessful"
                                        class="text-sm text-gray-600"
                                    >
                                        Added.
                                    </p>
                                </Transition>
                            </div>
                        </form>
                    </header>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
