<script setup lang="ts">
import InputError from "@/Components/Form/InputError.vue";
import InputLabel from "@/Components/Form/InputLabel.vue";
import { Contestant } from "@/types";
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import { onMounted, ref } from "vue";
import Dropdown from "@/Components/Form/Dropdown.vue";
import ContestantTypeahead from "@/Components/Form/ContestantTypeahead.vue";
import ImageUpload from "@/Components/Form/ImageUpload.vue";
import CountryTypeahead from "@/Components/Form/CountryTypeahead.vue";
import GradientButton from "@/Components/Buttons/GradientButton.vue";

const form = useForm({
    contestant: "",
    month: "",
    destination: "",
    image: null,
});

const contestants = ref<Contestant[]>([]);
const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];

const getContestants = () => {
    axios.get(route("api.v1.contestants.index")).then((response) => {
        contestants.value = response.data;
    });
};

const addSubmission = () => {
    form.post(
        route("contestants.submissions.store", { contestant: form.contestant }),
        {
            preserveScroll: true,
            onSuccess: () => {
                form.reset("month", "destination", "image");
            },
            onError: () => {},
        }
    );
};

onMounted(() => {
    getContestants();
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Add a submission</h2>

            <p class="mt-1 text-sm text-gray-600">
                Add a submission to the Globetrotter event.
            </p>
        </header>

        <form @submit.prevent="addSubmission" class="mt-6 space-y-6">
            <div>
                <InputLabel
                    for="contestant"
                    value="Select a Contestant"
                    required
                />

                <ContestantTypeahead
                    v-model="form.contestant"
                    :contestants="contestants"
                />

                <InputError :message="form.errors.contestant" class="mt-2" />
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div>
                    <InputLabel
                        for="destination"
                        value="Destination"
                        required
                    />
                    <CountryTypeahead
                        v-model="form.destination"
                        class="w-full"
                    />
                    <InputError
                        :message="form.errors.destination"
                        class="mt-2"
                    />
                </div>
                <div>
                    <InputLabel for="month" value="Month" required />
                    <Dropdown
                        id="month"
                        v-model="form.month"
                        :options="months"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.month" class="mt-2" />
                </div>
            </div>

            <div>
                <InputLabel for="image" value="Image" />
                <ImageUpload v-model="form.image" class="mt-1" />
                <InputError :message="form.errors.image" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <GradientButton :disabled="form.processing"
                    >Save</GradientButton
                >

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
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
